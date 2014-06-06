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

    	return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

}