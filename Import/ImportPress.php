<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 6/30/14
 * Time: 10:47 PM
 */

namespace Plugin\Diary\Import;


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

    public function __construct(SimpleXMLElement $items) {
        $this->simpleXML = $items;
        $this->title = $this->simpleXML->title;
        $this->description = $this->simpleXML->description;
        $this->category = $this->simpleXML->category;
        $this->getWPData (); // fetches all Data
    }

    /**
     * Handles the Processing of Retrieving the items from the XML
     */
    public function getItems(){
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
                "comment_id" => $items->comment_id,
                "comment_author" => ( string ) trim ( $items->comment_author ),
                "comment_author_mail" => $items->comment_author_email,
                "author_url" => $items->author_url,
                "comment_author_IP" => $items->comment_author_IP,
                "comment_date" => $items->comment_date,
                "comment_date_gmt" => $items->comment_date_gmt,
                "comment_content" => ( string ) trim ( $items->comment_content ),
                "comment_approved" => $items->comment_approved
            );
            array_push ( $this->comments, $data );
        }
    }
}

