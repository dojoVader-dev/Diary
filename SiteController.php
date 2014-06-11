<?php
namespace Plugin\Diary;
use Plugin\Diary\Forms\CommentForm;
class SiteController extends \Ip\Controller

{

    public function read()
    {

		$article=new Model();
		$id=(int)ipRequest()->getQuery('post');
		$commentForm=new CommentForm();

		$data=$article->getArticleById($id);
		$data['form']=$commentForm->getForm();
		return ipView(__DIR__."/view/_article.php",$data)->render();


    }





}
