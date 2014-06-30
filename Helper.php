<?php

namespace Plugin\Diary;

use Plugin\Diary\Forms\CategoryForm as CategoryForm;
use Plugin\Diary\Forms\NoteForm;
use Plugin\Diary\Forms\CommentForm;
use Plugin\Diary\Forms\UploadForm;

class Helper {
	/**
	 * Retrieves the name of the Admin currently logged in
	 *
	 * @author dojoVader
	 * @param
	 *        	none
	 * @return String name of author or null
	 */
	static public function getAuthor() {
		// Get the Admin ID currently logged in
		$id = ipAdminId ();
		$username = ipDb ()->selectRow ( 'administrator', 'username', array (
				'id' => $id
		) );
		if ($username) {

			return $username ['username'];
		} else {
			return null;
		}
	}
	static public function getList($limit) {
		$sql = sprintf ( "select * from %s LIMIT %d", ipTable ( "diary_blog" ), $limit );
		return ipDb ()->fetchAll ( $sql );
	}
	static public function getArticleById($id) {
		try{
		$sqlFormat="select ip_diary_blog.author,ip_diary_blog.date,ip_diary_blog.content,
    	ip_diary_blog.id,title,ip_diary_blog.status,ip_diary_blog.category_id,dc.id as dcid ,dc.name 
    	from ip_diary_blog INNER JOIN ip_diary_category dc ON ip_diary_blog.category_id=dc.id WHERE ip_diary_blog.id=:blog_id";
		if (! is_int ( $id )) {
			throw new \Ip\Exception\Plugin ( "Wrong Format passed in Diary Plugin in " . __CLASS__ );
		}
		//Bind the Value to the Statement
		$query=ipDb()->getConnection()->prepare($sqlFormat);
		$query->bindValue(":blog_id",$id,\PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch(\PDO::FETCH_ASSOC);
		return $result ? $result : array();
	}
	catch (\PDOException $e) {
            throw new \Ip\Exception\Db($e->getMessage(), $e->getCode(), $e);
        }
	}
	static public function getCategoryForm() {
		$category = new CategoryForm ();
		return $category->getForm ();
	}
	static public function getCommentForm(){
		$commentForm=new CommentForm();
		return $commentForm->getForm();
	}

	static public function getUploadForm(){
		$uploadForm=new UploadForm();
		return $uploadForm->getForm();
	}
	static public function getNoteForm() {
		$note = new NoteForm ();
		return $note->getForm ();
	}
	static public function getEditMenu() {
		$page1 = new \Ip\Menu\Item ();
		$page1->setTitle ( 'Create Category' );
		$page1->setUrl ( ipActionUrl ( array (
				"aa" => "Diary.createCategory"
		) ) );

		$page2 = new \Ip\Menu\Item ();
		$page2->setTitle ( 'Manage Category' );
		$page2->setUrl ( ipActionUrl ( array (
				"aa" => "Diary.manageCategory"
		) ) );

		$options = array (
				'items' => array (
						$page1,
						$page2
				), // menu to be displayed
				'attributes' => array (
						'id' => 'ipsTest'
				)
		);

		return ipSlot ( 'menu', $options );
	}
	static public function DeleteNote($id) {
		return ipDb ()->delete ( "diary_blog", array (
				"id" => $id
		) );
	}
	/**
	 * Sets the Url for the Diary Page
	 * @param Array $query
	 * @return string
	 */
	static function setDiaryUrl($query){
		return ipConfig()->baseUrl().ipContent()->getCurrentPage()->getUrlPath().'?'.http_build_query($query);
	}

	static function getContent($content,$data){
		$string=explode("<!--more-->",$content);
		if($string === FALSE){
			return $content;
		}
		else{
		return sprintf("%s<br/><a href='%s'>Read More</a>",$string[0],ipActionUrl(array("sa"=>"Diary.read","post"=>$data['id'])));
		}
	}
}

?>