<?php

namespace Plugin\Diary;

/**
 * This class is the Diary Database that will store and save information for the table Diary
 *
 * @author dojoVader
 *
 */
use Plugin\Diary\Helper as Helper;

class Model extends BaseModel {
	public $name="diary_blog";
	public $id;
	public $author, $date, $content, $title, $status;
	public $modified;
	public $comment;
	public $category_id;
	public function save() {
		$this->beforeSave ();
		// Save Data
		$saveData = array (
				"author" => $this->author,
				"date" => $this->date,
				"content" => $this->content,
				"title" => $this->title,
				"status" => $this->status,
				"modified" => $this->modified,
				"comment" => $this->comment,
				"category_id" => $this->category_id
		);
		return ipDb ()->insert ( "diary_blog", $saveData );
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
    			'data'=>$this->fetch($from, $pageSize),
    			'currentPage' => $currentPage,
    			'totalPages' => $totalPages,
    			'pagerSize' => $pageSize
    	) );
    	return $pagination;



    }

	private function fetch($from, $count, $where = 1) {

    	$sortField = 'id';
    	// select ip_diary_blog.author,ip_diary_blog.date,ip_diary_blog.content,ip_diary_blog.id,title,ip_diary_blog.status,ip_diary_blog.category_id,dc.id as dcid ,dc.name 
    	// from ip_diary_blog INNER JOIN ip_diary_category dc ON ip_diary_blog.category_id=dc.id

    	$sql = "select ip_diary_blog.author,ip_diary_blog.date,ip_diary_blog.content,
    	ip_diary_blog.id,title,ip_diary_blog.status,ip_diary_blog.category_id,dc.id as dcid ,dc.name 
    	from ip_diary_blog INNER JOIN ip_diary_category dc ON ip_diary_blog.category_id=dc.id ORDER BY " . $sortField . "
                LIMIT
                $from, $count
                ";

                $result = ipDb ()->fetchAll ( $sql );


    		return $result;
    }



	public function update() {
		$this->beforeSave ();
		$updateData = array (
				"author" => $this->author,
				"date" => $this->date,
				"content" => $this->content,
				"title" => $this->title,
				"status" => $this->status,
				"modified" => $this->modified,
				"comment" => $this->comment,
				"category_id" => $this->category_id
		);
		return ipDb ()->update ( "diary_blog", $updateData, array (
				"id" => $this->id
		) );
	}

	/**
	 * Returns Articles from the Database
	 *
	 * @return multitype:
	 */
	public function getArticles() {
		return Helper::getList ( ipGetOption ( 'Diary.diaryPosts' ) );
	}
	public function getArticleById($id) {
		return Helper::getArticleById ( $id );
	}
	public function Delete($id) {
		return Helper::DeleteNote ( $id );
	}
	private function beforeSave() {
		$this->date = $this->modified = date ( 'Y-m-d H:i:s', time () ); // Generate the time for now
		$this->author = Helper::getAuthor ();
	}
}

?>