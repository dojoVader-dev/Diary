<?php

namespace Plugin\Diary;

use Plugin\Diary\Forms\CategoryForm as CategoryForm;
use Plugin\Diary\Forms\NoteForm;
class Helper {
	/**
	 * Retrieves the name of the Admin currently logged in
	 * @author dojoVader
	 * @param none
	 * @return String name of author or null
	 */
	static public function getAuthor(){
		//Get the Admin ID currently logged in
		$id=ipAdminId();
		$username=ipDb()->selectRow('administrator','username',array('id'=>$id));
		if($username){

			return $username['username'];
		}else{
			return null;
		}
	}

	static public function getList(){
		return ipDb()->selectAll('diary_blog',"*");
	}

	static public function getArticleById($id){
		if(!is_int($id)){
			throw new \Ip\Exception\Plugin("Wrong Format passed in Diary Plugin in ".__CLASS__);
		}
		return ipDb()->selectRow('diary_blog',"*",array('id'=>$id));
	}

	static public function getCategoryForm(){
		$category=new CategoryForm();
		return $category->getForm();
	}
	static public function getNoteForm(){
		$note= new NoteForm();
		return $note->getForm();
	}

	static public function getEditMenu(){

		$page1 = new \Ip\Menu\Item();
		$page1->setTitle('Create Category');
		$page1->setUrl(ipActionUrl(array("aa"=>"Diary.createCategory")));

		$page2 = new \Ip\Menu\Item();
		$page2->setTitle('Manage Category');
		$page2->setUrl(ipActionUrl(array("aa"=>"Diary.manageCategory")));

		$options = array(
				'items' => array($page1, $page2), //menu to be displayed
				'attributes' => array ('id' => 'ipsTest')
		);

		return ipSlot('menu', $options);

	}

	static public function DeleteNote($id){
		return ipDb()->delete("diary_blog",array("id"=>$id));
	}
}

?>