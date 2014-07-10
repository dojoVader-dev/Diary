<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 6/30/14
 * Time: 10:47 PM
 */

namespace Plugin\Diary\Import;
use Plugin\Diary\Helper;
use Plugin\Diary\CategoryModel;
use Plugin\Diary\Model;
use Plugin\Diary\CommentModel;


class ImportPress {
    protected $type="";
    protected $namespace=array(
        "excerpt"=>"http://wordpress.org/export/1.2/excerpt/",
        "content"=>"http://purl.org/rss/1.0/modules/content/",
        "wfw"=>"http://wellformedweb.org/CommentAPI/",
        "dc"=>"http://purl.org/dc/elements/1.1/",
        "wp"=>"http://wordpress.org/export/1.2/"
    );
    protected $title,$description,$post_id,$comment_status,$post_name,$time;
    protected $simpleXML, $content;
    private $comments = array ();
    private $category;

    private $Saved_Category_ID;
    private $Saved_Post_ID;



    public function __construct(\SimpleXMLElement $items) {
        $this->simpleXML = $items;
        $this->title = $this->simpleXML->title;
        $this->description = $this->simpleXML->description;
        $this->category = $this->simpleXML->category;
        $this->getItems(); // fetches all Data
    }

    /**
     * Handles the Processing of Retrieving the items from the XML
     * @return void
     */
    private function getItems(){
        $WPData = $this->simpleXML->children ( $this->namespace ["wp"] );
        $this->post_id = $WPData->post_id;
        $this->post_name = $WPData->post_name;
        $this->type = $WPData->post_type;
        $this->comment_status = $WPData->comment_status;
        $this->image_url = $WPData->attachment_url;
        $this->time=$WPData->post_date;
        // Fetch the Content to be Used
        $Content = $this->simpleXML->children ( $this->namespace ["content"] );

        $this->content = ( string ) trim ( $Content->encoded );
        $this->category = $this->simpleXML->category;
        // Comments
        $Comments = $WPData->comment;

        foreach ( $Comments as $items ) {

            $data = array (

                "author" => ( string ) trim ( $items->comment_author ),
                "email" => $items->comment_author_email,
                "url" => $items->author_url,
                "date" => $items->comment_date,
                "modified"=>date( 'Y-m-d H:i:s', time()),
                "content" => ( string ) trim ( $items->comment_content ),
                "approved" =>(int) $items->comment_approved,
                "parent"=>0
            );
            array_push ( $this->comments, $data );
        }
    }

    /**
     * Imports the Category for the Post
     */
    public function importCategory(){
        #let's save the Category to the Database before the HR Catches me
        $CategoryData=array();
        $CategoryData['name']=$this->category['nicename'];
        $CategoryData['description']="Description of the Category to be Set";
        $CategoryData['count']=0;
        //Save the Data
        $CategorModel=new CategoryModel();
        if($CategorModel->keyExists("name",$CategoryData['name'])){
            $this->Saved_Category_ID=ipDb()->selectValue("diary_category",'id',array('name'=>$CategoryData['name']));
        }
        else{
            $this->Saved_Category_ID=$CategorModel->save($CategoryData);
        }

    }

    public function importComments(){
        foreach($this->comments as $data){
        //Save the comments in the database

            $CommentModel= new CommentModel();
            $CommentModel->email=$data['email'];
            $CommentModel->author=$data['author'];
            $CommentModel->url=$data['url'];
            $CommentModel->date=$data['date'];
            $CommentModel->content=$data['content'];
            $CommentModel->approved=$data['approved'];
            $CommentModel->parent=$data['parent'];
            $CommentModel->post_id=$this->Saved_Post_ID;
            $CommentModel->save();

        }
    }

    /**
     * @todo Remove HardCoded Status
     */
    public function importPost(){
      //Save the Post
      $Model=new Model();
      $Model->author=Helper::getAuthor();
      $Model->date=$this->date;
      $Model->content=$this->content;
      $Model->title=$this->title;
      $Model->status=1;
      $Model->category_id=$this->Saved_Category_ID;
      $this->Saved_Post_ID=$Model->save();
    }
}

