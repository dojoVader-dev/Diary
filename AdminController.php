<?php

namespace Plugin\Diary;

/**
 *
 * @todo Add Explicit Namespace for Model to avoid Collision
 * @author x64
 *
 */
class AdminController extends \Ip\GridController {
	public $model;
	/**
	 * The Url to create the Note
	 */
	public function create() {
		$categoryModel = new CategoryModel ();
		ipAddCss ( "assets/css/sdk.css" );
		ipAddJs ( "assets/js/ckeditor.js", null, 50 );
		ipAddJsContent("create","
			require(['Diary/create'],function(create){
				create.init();
						jQuery(document).ready(function(){
		for(var i in CKEDITOR.instances) {
		  CKEDITOR.instances[i].on('blur', function() { this.updateElement(); });

		}
		});
				});
				");
		$noteform = Helper::getNoteForm ();
		$noteform->getField ( 'category_id' )->setValues ( $categoryModel->getCategoryOptions () );
		$formView = $noteform->render ( ipView ( "view/backend/form/add.php" ) );
		return ipView ( "view/backend/add.php", array (
				'form' => $formView
		) );
	}

	public function index() {
		$model = new Model ();
	    $currentPageIdx=ipRequest()->getQuery("current",1);
		$posts = $model->getPaginator("diary_blog", $currentPageIdx,(int)ipGetOption ( 'Diary.diaryPosts' ));

		$articles=$posts->render(__DIR__."/view/backend/listArticles.php");

		return ipView ( "view/backend/ui.php", array (
				'articles' => ($articles === null ) ? "<h1>No Notes</h1>" : $articles
		) );
	}
	public function grid()
	{
		$worker = new \Ip\Internal\Grid\Worker($this->config());
		$result = $worker->handleMethod(ipRequest());

		if (is_array($result) && !empty($result['error']) && !empty($result['errors'])) {
			return new \Ip\Response\Json($result);
		}

		return new \Ip\Response\JsonRpc($result);
	}
	public function edit() {
		$id = ( int ) ipRequest ()->getQuery ( 'id' );
		if (! is_int ( $id )) {
			throw new \Ip\Exception\Plugin ( 'Integer Parameter is Required' );
		}
		$model = $this->loadModel ();
		$edit = $model->getArticleById ( $id );
		$categoryModel = new CategoryModel ();

		ipAddCss ( "assets/css/sdk.css" );
		ipAddJs ( "assets/js/ckeditor.js", null, 50 );
				ipAddJsContent("create","
			require(['Diary/create'],function(create){
						create.init();
									jQuery(document).ready(function(){
		for(var i in CKEDITOR.instances) {
		  CKEDITOR.instances[i].on('blur', function() { this.updateElement(); });

		}
		});
				});
				");
		$noteform = Helper::getNoteForm ();
		//Set the fields
		// $noteform->getField('author')->setValue($edit['author']);
		$noteform->getField('title')->setValue($edit['title']);
		$noteform->getField('content')->setValue($edit['content']);
		$noteform->getField('aa')->setValue('Diary.AjaxUpdateNote');
		$noteform->getField('create')->setValue('Update');
		$noteform->getField('updateField')->setValue($edit['id']);

		$noteform->getField ( 'category_id' )->setValues ( $categoryModel->getCategoryOptions () );
		$noteform->getField('category_id')->setValue($edit['category_id']);
		$formView = $noteform->render ( ipView ( "view/backend/form/add.php"));
		return ipView ( "view/backend/add.php", array (
				'form' => $formView
		) );
	}
	public function importWordPress(){
		$form=Helper::getUploadForm();
		return ipView("view/backend/import.php",array("form"=>$form));
	}
	private function loadModel() {
		if (! $this->model instanceof \Plugin\Diary\Model && $this->model == null) {
			$this->model = new Model ();
		}
		return $this->model;
	}
	public function createCategory() {
		$articles = Helper::getEditMenu ();
		$form = Helper::getCategoryForm ();
		return ipView ( "view/backend/category.php", array (
				"articles" => $articles,
				"form" => $form
		) );
	}
	public function AjaxArticles() {
		$model = new Model ();
		$id = ( int ) ipRequest ()->getPost ( 'id' );
		return new \Ip\Response\Json ( $model->getArticleById ( $id ) );
	}
	/**
	 * Ajax method to create Note for the Diary
	 */
	public function AjaxCreateNote() {
		if (ipRequest ()->isPost ()) {
			$form = Helper::getNoteForm ();
			$errors = $form->validate ( ipRequest ()->getPost () );
			if ($errors) {
				// error
				$data = array (
						'status' => 'error',
						'errors' => $errors
				);
			} else {
				// success
				$note = new Model ();
				$note->content = ipRequest ()->getPost ( 'content' );
				$note->status = ipRequest ()->getPost ( 'status' );
				$note->comment = 0;
				$note->category_id = ipRequest ()->getPost ( 'category_id' );

				$note->title = ipRequest ()->getPost ( 'title' );
				if ($id = $note->save ()) {
					// Redirect to the Edit Page
				//Success
				$data=array(
					"status"=>"success",
					"message"=>sprintf("The Note has been created successfully #%d",$id),
					"redirect"=>true,
					"recordID"=>$id
				);
				}
			}
		}
		return new \Ip\Response\Json($data);
	}
	/**
	 * Deletes the Note from the Database
	 * @return \Ip\Response\Json Array of Result or Status ['status'=>'','message'=>'']
	 */
	public function AjaxNoteDelete(){
		$message=array();
		if(ipRequest()->isPost()){
			$id=(int)ipRequest()->getPost('id');
			if(!is_integer($id)){
				$message['status']='error';
				$message['message']="The Post ID is not an integer";
			}
			else{
				$model=new Model();
				if($model->Delete($id)){
					$message['status']='success';
					$message['message']=sprintf("The Note %d was successfully deleted from the Database",$id);
				}
				else{
					$message['status']='error';
					$message['message']=sprintf("MySQL Says: %s",mysql_error());
				}
			}
		}
		return new \Ip\Response\Json($message);
	}
	public function AjaxUpdateNote() {
		if (ipRequest ()->isPost ()) {
			$form = Helper::getNoteForm ();
			$errors = $form->validate ( ipRequest ()->getPost () );
			if ($errors) {
				// error
				$data = array (
						'status' => 'error',
						'errors' => $errors,
						'message'=>"An Error occurred on the Server"
				);
			} else {
				// success
				$note = new Model ();
				$note->content = ipRequest ()->getPost ( 'content' );
				$note->status = ipRequest ()->getPost ( 'status' );
				$note->category_id = ipRequest ()->getPost ( 'category_id' );
				$note->title = ipRequest ()->getPost ( 'title' );
				$note->id=ipRequest()->getPost('updateField');
				if ($id = $note->update()) {
					// Redirect to the Edit Page
					//Success
					$data=array(
							"status"=>"success",
							"message"=>sprintf("The Note %s has been updated successfully ",$note->title)
					);
				}
			}
		}
		return new \Ip\Response\Json($data);
	}
	/**
	 * The Ajax Method to Save the Content
	 */
	public function AjaxCreateCategory() {
		if (ipRequest ()->isPost ()) {
			$form = Helper::getForm ();
			$errors = $form->validate ( ipRequest ()->getPost () );
			if ($errors) {
				// error
				$data = array (
						'status' => 'error',
						'errors' => $errors
				);
			} else {
				// success
				$category = new CategoryModel ();
				$saveData = array (
						"name" => ipRequest ()->getPost ( 'name' ),
						"description" => ipRequest ()->getPost ( 'description' )
				);

				$category->save ( $saveData );
				$data = array (
						'status' => 'ok'
				);
			}
			return new \Ip\Response\Json ( $data );
		}
	}
	public function comment() {
		return $this->manageCategory ();
	}
	public function manageCategory() {
		// HEhehehehe Borrowed Code from GridController
		ipAddJsVariable('GridAction',ipRequest ()->getRequest ( 'aa' ));
		ipAddJs('assets/js/Grid.js');
		ipAddJs ( 'Ip/Internal/Grid/assets/gridInit.js' );



		$controllerClass = get_class ( $this );
		$controllerClassParts = explode ( '\\', $controllerClass );

		$aa = $controllerClassParts [count ( $controllerClassParts ) - 2] . '.grid';

		$gateway = array (
				'aa' => $aa,
				'action' => ipRequest ()->getRequest ( 'aa' )
		);

		$variables = array (
				'gateway' => $gateway
		);
		$content = ipView ( 'view/backend/placeholder.php', $variables )->render ();
		return $content;
	}
	public function config() {
		switch (ipRequest ()->getRequest ( "action" )) {
			case "Diary.manageCategory" :
				return array (
						'title' => 'Category List',
						'type'=>'table',
						'table' => 'diary_category',
						'deleteWarning' => __ ( 'Do you really want to delete this item?', 'FormExample' ),
						'sortField' => 'id',
						'createPosition' => 'top',
						'pageSize' => 25,
						'fields' => array (
								array (
										'label' => __ ( 'ID title', 'Category' ),
										'field' => 'id'
								),
								array (

										'label' => __ ( 'Name', 'Category' ),
										'field' => 'name',
										'validators' => array (
												'Required'
										)
								),
								array (
										'label' => __ ( 'Category Description', 'Category' ),
										'field' => 'description',
										'validators' => array (
												'Required'
										)
								),

								array (
										'label' => __ ( 'Attached Articles', 'Category' ),
										'field' => 'count'
								)
						)
				)
				;
				break;

			case "Diary.comment" :
				return array (
						'title' => 'Comment List',
						'type'=>'table',
						'table' => 'diary_comments',
						'deleteWarning' => __ ( 'Do you really want to delete this item?', 'FormExample' ),
						'sortField' => 'id',
						'createPosition' => 'top',
						'pageSize' => 25,
						'fields' => array (

								array (

										'label' => __ ( 'Name', 'Comment' ),
										'field' => 'author',
										'validators' => array (
												'Required'
										)
								),
								array (
										'label' => __ ( 'Comment', 'Comment' ),
										'field' => 'content',
										'validators' => array (
												'Required'
										)
								),
								array(
									'type'=>'Select',
									'label'=>'Enable Comments',
									'field'=>'approved',
									'values'=>array(
										array(CommentModel::APPROVED,"Approve"),
										array(CommentModel::PENDING,"Pending")
									)
								),

								array (
										'label' => __ ( 'Date', 'Comment' ),
										'field' => 'date'
								)
						)
				)
				;
				break;
		}
	}
}

?>