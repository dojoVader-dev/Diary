define(['dijit/Dialog'],function(dialog) {
	"use strict";
    var dia = new dialog({
        title: "Comment Page",
        content: "Submitting Comment"
    });
    return {
        init: function() {
            //Catch the Response Data from the Request
            jQuery(document).on("ipSubmitResponse", function(e, resp) {
                console.log(resp.status);
                if ("status" in resp) {
                    switch (resp.status) {
                        case "error":
                            dia.set('content',resp.errors);
                            dia.set('title',"Comment Status")
                            dia.show();

                            break;
                        case "success":
                            dia.set('content',resp.message);
                            dia.set('title',"Comment Status")
                            dia.show();

                            break;
                    }
                }
               if(resp.status === "success"){
            	   //Clear the Form
            	   jQuery(".ipModuleForm")[0].reset();               }
            });
        }
    }
});