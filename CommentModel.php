<?php
namespace Plugin\Diary;
/**
 *@author x64
 *@propety string author
 *@property string email
 *@property content
 *@property url
 *@property date
 *@property modified
 *@property approved
 *@property parent
 */
class CommentModel extends BaseModel
{
    public $name="diary_comments";
    public $post_id;
    public $author, $email, $content, $url, $date, $modified, $approved, $parent;
	const PENDING=0;
	const APPROVED=1;
    /**
     * Save the Data to the Database
     * @return mixed
     * */
    public function save() {
        $this->beforeSave();
        //Save the Data to the Database
        $inserts = array("author"=>null, "email"=>null, "content"=>null, "url"=>null, "date"=>null, "modified"=>null, "approved"=>null, "parent"=>null,"post_id"=>null);
        //Assign the data
        foreach($inserts as $property=>&$value){
            if(isset($this->{$property})){
                $value=$this->{$property};
        	}
        }
        return ipDB()->insert('diary_comments',$inserts);

    }

	/**
	 * Update the Comment Table
	 * @param Array of Update Field $data
	 * @param Array array('id'=>'1') $where
	 * @return Ambigous <number, boolean>
	 */
    public function update($data,$where){
    	return ipDB()->update("diary_comments", $data,$where);
    }

    private function beforeSave(){
    	$this->date=$this->modified=date('Y-m-d H:i:s',time());
    	$this->approved=self::PENDING;
    	$this->parent=0;
    }

    public function getComments($current=1){
    	return $this->getPaginator("diary_comments",$current,20/*Oh oh hard Coding*/);
    }
}
?>