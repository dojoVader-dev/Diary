<?php
namespace Plugin\Diary;

class PublicController extends \Ip\Controller
{

    public function read()
    {

		$article=new Model();
		$id=(int)ipRequest()->getQuery('post');

		$data=$article->getArticleById($id);
		return ipView(__DIR__."/view/_article.php",$data)->render();


    }





}
