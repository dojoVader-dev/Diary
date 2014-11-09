/**
 * The Bootup for the Diary that loads the script
 */
require(['Diary/DiaryController','dojo/parser'],function(DiaryController,parser){
"use strict";
	$('document').ready(function(){
		document.body.className+=" claro";
        //Fix the Height of left sidebar
        $("div.ui-diary-left").height($('body').height());
		parser.parse();
	});
});