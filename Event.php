<?php

namespace Plugin\Diary;

class Event {

	public static function ipBeforeController($e){
		//We don't want it to run on every Plugin

		if($e['plugin'] === "Diary" && $e['controller'] === "AdminController"){
		$submenu=Submenu::getSubmenuItems();
		ipAddCss("assets/css/diary.css");
		ipResponse()->setLayoutVariable("submenu",$submenu);
		$path=ipFileUrl('Plugin/Diary/assets/js');
		ipAddJsContent("dojoConfig","var dojoConfig={
		async:true,
		parseOnLoad:false,
		selectorEngine: 'acme',
		 packages
		 :[{name:'Diary',location:'$path'}]
		}",40);
		ipAddJs("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dojo/dojo.js",null,50);
		ipAddJs("assets/js/boot.js",null,90);
		ipAddCss("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dijit/themes/claro/claro.css");
		}
		else if($e['plugin'] === 'Diary' && $e['controller'] === "SiteController"){
			$path=ipFileUrl('Plugin/Diary/assets/js');
			ipAddJsContent("dojoConfig","var dojoConfig={
			async:true,
			parseOnLoad:false,
			selectorEngine: 'acme',
			packages
			:[{name:'Diary',location:'$path'}]
			}",40);
			ipAddJs("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dojo/dojo.js",null,50);
			ipAddJs("assets/js/boot.js",null,90);
			ipAddJs("assets/js/holder.js",null,90);
			ipAddCss("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dijit/themes/claro/claro.css");
			//Font Awesome
			ipAddCss("http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");
		}
	}
}

?>