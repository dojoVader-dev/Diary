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
class CommentModel
{
    public $post_id;
    public $author, $email, $content, $url, $date, $modified, $approved, $parent;

    /**
     * Save the Data to the Database
     * @return mixed
     * */
    public function save() {
        $this->beforeSave();
        //Save the Data to the Database
        $inserts = array("author", "email", "content", "url", "date", "modified", "approved", "parent");
        //Assign the data
        foreach($inserts as $property){
        	if(property_exists($this, $property)){
        		$property=$this->{$property};
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
    }
}
?>