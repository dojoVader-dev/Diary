/**
 * The Bootup for the Diary that loads the script
 */
require(['dojo/parser'],function(DiaryController,parser){
"use strict";
	$('document').ready(function(){
		document.body.className+=" claro";
		parser.parse();
	});
});