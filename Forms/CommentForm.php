<?php

namespace Plugin\Diary\Forms;

use Plugin\Diary\Helper;
use Plugin\Diary\CategoryModel;
use Ip\Form;

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
		//Create the FieldSet looks to Boring
		$this->_form->addFieldset(new \Ip\Form\Fieldset("Leave a Reply"));
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

		$website=new \Ip\Form\Field\Text(
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

		$this->_form->addField(new \Ip\Form\Field\Submit(
				array(
						'value' => 'Submit',
						'css'=>"btn btn-primary"
				)
		));

		$this->_form->addField(new \Ip\Form\Field\Hidden(array(
				'name' => 'aa',
				'value' => 'Diary.commentSave',
		)));
		$this->_form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);
		$this->_form->setMethod(\Ip\Form::METHOD_POST);



	}

	public function getForm(){
		return $this->_form;
	}
}
?>