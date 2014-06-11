<?php

namespace Plugin\Diary\Forms;

use Plugin\Diary\Helper;
use Plugin\Diary\CategoryModel;

/**
 * This contains the Form to create the Comment form
 *
 * @todo Check if same form can handle
 * @author x64
 *
 */
class CommentForm {
	/**
	 * Comment Form
	 * @var \Ip\Form
	 */
	private $_form;

	public function __construct(){
		$this->_form=new \Ip\Form();
		$this->createFields();

	}
	/**
	 * Create the Fields for the Form
	 */
	public function createFields(){
		$name=new \Ip\Form\Field\Text(
			 array(
			'name'=>'author',
			 'label'=>'Name'

		)
		);
		$name->addValidator("Required");

		$this->_form->addField($name);

		$email=new \Ip\Form\Field\Email(
			array(
			'name'=>'email',
			'label'=>'Email'
		)
		);
		$email->AddValidator("Required");
		$email->addValidator("Email");

		$this->_form->addField($email);

		$website=new \Ip\Form\Field\Url(
			array(
			"name"=>"url",
			"label"=>"Website"
		)
		);

		$this->_form->addField($website);

		$message=new \Ip\Form\Field\Textarea(
			array(
			"name"=>'message',
			'label'=>"Comment"
		)
		);

		$message->addValidator("Required");

		$this->_form->addField($message);



	}
}
?>