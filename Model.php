<?php

namespace Plugin\Diary;

/**
 * This class is the Diary Database that will store and save information for the table Diary
 *
 * @author dojoVader
 *
 */
use Plugin\Diary\Helper as Helper;

class Model {
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
	/**
	 * This returns the Paginator holding the data
	 *
	 * @param unknown $table
	 * @param unknown $ppp
	 */
	public function getPaginator($table, $currentPageIdx) {
		// let's fetch the total from the Database first
		$pageSize=(int) ipGetOption ( 'Diary.diaryPosts' ) ;
		$recordCount = (int)ipDb ()->fetchValue ( sprintf ( "SELECT COUNT(*) from %s", ipTable ($table) ) );
		$totalPages = ceil ( $recordCount / $pageSize);
		$currentPage = $currentPageIdx;
		if ($currentPage > $totalPages) {
			$currentPage = $totalPages;
		}
		$from = ($currentPage - 1) * $pageSize;

		$pagination = new \Ip\Pagination\Pagination ( array (
				'data'=>$this->fetch($from, $pageSize),
				'currentPage' => $currentPage,
				'totalPages' => $totalPages,
				'pagerSize' => $pageSize
		) );
		return $pagination;
	}
	public function fetch($from, $count, $where = 1) {

			$sortField = 'id';


		$sql = "
        SELECT
          *
        FROM
          " . ipTable("diary_blog") . "
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