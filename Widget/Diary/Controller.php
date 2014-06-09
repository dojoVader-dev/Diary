<?php
/**
 * @package ImpressPages

 *
 */
namespace Plugin\Diary\Widget\Diary;





use Plugin\Diary\Model;
class Controller extends \Ip\WidgetController{


    public function getTitle() {
    	return __('Diary Notes', 'ipAdmin');

    }
    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
    	$articlesData=new Model();
    	$data['items']=$articlesData->getArticles();
    	$model=new Model();
    	$currentPageIdx=ipRequest()->getQuery("current",1);
    	$posts = $model->getPaginator("diary_blog", $currentPageIdx);
		$content=$posts->render(__DIR__."/../../view/_blogs.php");
		$data['content']=($content === null) ? ipView(__DIR__."/../../view/empty.php") : $content;
    	return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

}