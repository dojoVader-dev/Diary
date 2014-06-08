<?php

namespace Plugin\Diary\Forms;

class CategoryForm {
	/**
	 * \Ip\Form Class
	 * @var \Ip\Form
	 */
	private $form;
	public function __construct() {
		$this->form=new \Ip\Form();
		$this->createFields();
	}

	private function createFields(){
		//Create the Field for Name
		$name=new \Ip\Form\Field\Text(
	array(
			'name'=>'name',
			'label'=>'Enter Name of Category'
		)

		);
		$name->addValidator("Required");
		$this->form->addField($name);
		//Create the Field for Description

		$description=new \Ip\Form\Field\Textarea(
				array(
						'name'=>'description',
						'label'=>'Enter Name of Description'
				)

		);
		$description->addValidator("Required");
		$this->form->addField($description);

		$this->form->addField(new \Ip\Form\Field\Submit(
				array(
						'value' => 'Save'
				)
		));
		$this->form->addField(new \Ip\Form\Field\Hidden(array(
				'name' => 'aa',
				'value' => 'Diary.AjaxCreateCategory',
		)));
		$this->form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);
		$this->form->setMethod(\Ip\Form::METHOD_POST);


	}

	public function getForm(){
		return $this->form;
	}
}

?>