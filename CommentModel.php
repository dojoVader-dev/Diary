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
    	$this->approved=self::PENDING;
    	$this->parent=0;
    }

    public function getComments($current=1){
    	return $this->getPaginator("diary_comments",$current,20/*Oh oh hard Coding*/);
    }

    public function getPaginator($table, $currentPageIdx,$pageSize) {
        // let's fetch the total from the Database first
        /**
        @todo hardcoded value, change later
         */
        $pageSize=30;
        $recordCount = (int)ipDb ()->fetchValue ( sprintf ( "SELECT COUNT(*) from %s", ipTable ($table) ) );
        $totalPages =(int) ceil ( $recordCount / $pageSize);
        $currentPage = $currentPageIdx;
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        $from = (abs($currentPage - 1)) * $pageSize;

        //Empty Result
        $pagination = new \Ip\Pagination\Pagination ( array (
            'data'=>$this->fetch($from, $pageSize,"post_id=".$this->post_id),
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'pagerSize' => $pageSize
        ) );
        return $pagination;



    }

    private function fetch($from, $count, $where = 1) {

        $sortField = 'date';


        $sql = "
        SELECT
          *
        FROM
          " . ipTable($this->name) . "
        WHERE
          " . $where . "
        ORDER BY
            `" . $sortField . "`
                LIMIT
                $from, $count
                ";

        $result = ipDb ()->fetchAll ( $sql );


        return $result;
    }




}
?>