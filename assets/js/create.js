define(function(){
"use strict";

	var Create={
		init:function(){
			//Let's bind to event finish but let's ask Dojo for Connect

			jQuery(document).on("ipSubmitResponse",function(e,resp){
				console.log(resp.status);
				if("status" in resp){
					switch(resp.status){
						case "error":
						//Error
							var CacheElement=$('#DiaryDialog');
				        	 CacheElement.find('.modal-body').html(resp.message);
				        	 CacheElement.find('.modal-title').html('Note Status');
				        	 CacheElement.modal('show');
						break;

						case "success":
							var CacheElement=$('#DiaryDialog');
				        	 CacheElement.find('.modal-body').html(resp.message);
				        	 CacheElement.find('.modal-title').html('Note Status');
				        	 CacheElement.modal('show');
				        	 //Redirect if on Create function
				        	 if(resp.redirect){
				        		 var RedirectURL="?aa=Diary.edit&id="+resp.recordID;
				        		 location.href=ip.baseUrl+RedirectURL;
				        	 }
						break;


					}
				}

			});
		}
	}

	return Create;

});