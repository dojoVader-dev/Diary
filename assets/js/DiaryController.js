define(['dojox/mvc/Output','dojo/Stateful','dojox/mvc/at','dojo/on',
        'dijit/form/Select'],
		function(output,stateful,at,on){
"use strict";
	//Set the MVC At to the Global Variable
	window.at=at;

	//Create a Model Object
	var Model={},Diary={};
	Model.Article={};
	Model.Article.title="Click any of the Articles to load the Content";
	Model.Article.content="Hello Content";
	Model.Article.id=0;

	//Create Stateful Model that will be binded to MVC Widgets
	var statefulModel=new stateful(Model.Article);
	window.DiaryModel=statefulModel; //Set the Model to Global @todo Remove from Global Space

	Diary.fetch=function(id){
		//Let's use JQuery Ajax to fetch data
		 $.ajax({
             type: 'POST',
             url: ip.baseUrl,
             data: {
             aa:'Diary.AjaxArticles',
             id:id,
             securityToken: ip.securityToken,
             },
             context: Model,
             cache:true,
             dataType: 'json'
         }).done(function(data){
        	 var ArticleM={};
        	 for(var i in data){
        		 //Set All properties in Article
        		if(i in statefulModel){
        			//The property exists let's trigger it
        			statefulModel.set(i,data[i]);

        		}else{
        			//Not there but let's set it regardless
        			statefulModel[i]=data[i];
        			//Do we trigger regardless

        			statefulModel.set(i,data[i]);
        		}

        	 }
        	 //Set the Model to Reflect Value
        	 statefulModel.set('Article',ArticleM);
         }).fail(function(error){

        	 alert(error.responseText);
         });
	}
	//Bind Events to Articles

	on($("a.Diary_AjaxTitle"),'click',function(e){
		//For Browsers that don't support DataSet
		var id = e.currentTarget.dataset.articleid ||  ParseInt(e.currentTarget.getAttribute('data-articleid'));
		Diary.fetch(id);
		//You Shall not Pass Buhahahahahahaha (-_-)
		e.preventDefault();
		e.stopPropagation();
	});

	on($("button.ajaxLinkDelete"),'click',function(e){
			//small nifty function to handle params

		 $.ajax({
             type: 'POST',
             url: ip.baseUrl,
             data: {
             aa:"Diary.AjaxNoteDelete",
             id:e.currentTarget.dataset.id,
             securityToken: ip.securityToken,
             },
             context: Model,
             cache:true,
             dataType: 'json'
         }).done(function(data){
        	 var CacheElement=$('#DiaryDialog');
        	 CacheElement.find('.modal-body').html(data.message);
        	 CacheElement.find('.modal-title').html('Delete Note Status');
        	 CacheElement.modal('show');
        	 //Remove the ID
        	 $("#post-"+e.currentTarget.dataset.id).remove();
         }).fail(function(error){
        	 var CacheElement=$('#DiaryDialog');
        	 CacheElement.find('.modal-body').html(data.message);
        	 CacheElement.find('.modal-title').html('Delete Note Status');
        	 CacheElement.modal('show');

         });
			//You Shall not Pass Buhahahahahahaha (-_-)
			e.preventDefault();
			e.stopPropagation();
	});



});