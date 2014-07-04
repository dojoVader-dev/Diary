<?php

namespace Plugin\Diary\Forms;

use Plugin\Diary\Helper;
use Plugin\Diary\CategoryModel;

/**
 * This contains the Form to create the Note form
 *
 * @todo Check if same form can handle
 * @author x64
 *
 */
class UploadForm {
	private $form;
	public function __construct() {
		$this->form = new \Ip\Form ();
		$this->createFields ();
	}
	public function createFields() {

		$this->form->addFieldset(new \Ip\Form\Fieldset("Upload WordPress XML"));
		$upload=new \Ip\Form\Field\File(array(
			'name'=>'wordpress_file',
			'value'=>'Browse'
		));
		$upload->addValidator("Required");

		$this->form->addField($upload);


		//set the Admin Form
		$this->form->addField(new \Ip\Form\Field\Hidden(array(
				'name' => 'aa',
				'value' => 'Diary.importWordPress',
		)));
		//Create the create submit button
		$this->form->addField(new \Ip\Form\Field\Submit(
				array( 'name'=>'upload',
						'value' => 'Submit',
						'css'=>'btn btn-primary'
				)
		));
		$this->form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);
		$this->form->setMethod(\Ip\Form::METHOD_POST);
        $this->form->addAttribute("enctype","multipart/form-data");
        $this->form->setAjaxSubmit(false);
	}
	public function getForm(){
		return $this->form;
	}
}
?>