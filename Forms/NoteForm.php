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
class NoteForm {
	private $form;
	public function __construct() {
		$this->form = new \Ip\Form ();
		$this->createFields ();
	}
	public function createFields() {

		// create Author Field
		$author = new \Ip\Form\Field\Hidden(array(
			'name'=>'author'
		));
		$author->setValue(Helper::getAuthor ());
		$this->form->addField($author);

		// create date Field
		$date = new \Ip\Form\Field\Hidden ( array (
				'name' => 'date'
		) );

		$this->form->addField ( $date );

		// create content Field
		$content = new \Ip\Form\Field\Textarea ( array (
				'name' => 'content',
				'label'=>'Add your Content'
		) );
		$this->form->addField ( $content );

		// create title field
		$title = new \Ip\Form\Field\Text ( array (
				'name' => 'title',
				'label'=>'Enter Title'
		) );
		$title->addValidator ( "Required" );
		$this->form->addField ( $title );

		// create the status field
		$status = new \Ip\Form\Field\Select ( array (
				'name' => "status",
				'label'=>'Note Visibility',
				'values' => array (
						array (
								CategoryModel::DRAFT,
								'Draft'
						),
						array (
								CategoryModel::PUBLISHED,
								'Published'
						)
				),
				'value'=>1
		)
		 );
		$this->form->addField($status);

		//create the modified field
		$modified = new \Ip\Form\Field\Hidden(array('name'=>'modified'));
		$this->form->addField ( $modified );

		$updateField = new \Ip\Form\Field\Hidden(array('name'=>'updateField'));
		$this->form->addField ( $updateField );

		//create catrgory id
		$categoryId=new \Ip\Form\Field\Select(array('name'=>'category_id'));
		$categoryId->setLabel("Select Category");
		$categoryId->addValidator("Required");
		$this->form->addField($categoryId);

		//Create the create submit button
		$this->form->addField(new \Ip\Form\Field\Submit(
				array( 'name'=>'create',
						'value' => 'Create'
				)
		));
		//set the Admin Form
		$this->form->addField(new \Ip\Form\Field\Hidden(array(
				'name' => 'aa',
				'value' => 'Diary.createnote',
		)));
		$this->form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);
		$this->form->setMethod(\Ip\Form::METHOD_POST);
        $this->form->setAjaxSubmit(false);

	}
	public function getForm(){
		return $this->form;
	}
}
?>