<?php
if($articles):
?>

<div class="ipModuleAdministrators ipsModuleAdministrators edit">
    <div class="col-sm-3 col-lg-1 col-md-1 ui-diary-left">
        <ul class="nav nav-pills nav-stacked" role="tablist" style="max-width: 300px;">
            <li role="presentation" class="active"><a href="#"><img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRbezqZpEuwGSvitKy3wrwnth5kysKdRqBW54cAszm_wiutku3R" name="aboutme" border="0" class="img-circle img-responsive"></a></a></li>
            <li role="presentation"><a href="#"><i class="fa fa-pencil-square-o fa-3x"></i><p>Articles</p></a>
            </li>
            <li role="presentation"><a href="#"><i class="fa fa-comments-o fa-3x"></i><p>Comments</p></a></li>
        </ul>
        </div>
    <br /><br />
	<div class="col-md-8 col-lg-8 col-sm-8 col-xs-8" >

		<div class="diarybar">
		<i class="fa fa-pencil pull-left"> <span data-dojo-type='dojox/mvc/Output' id='DiaryTitle' data-dojo-props="value: at(DiaryModel, 'title')"></span></i>
		<!-- Right -->
		<a href="${this.value}" id='EditLink' title="Edit" data-dojo-type="dojox/mvc/Output" data-dojo-props="value:at(DiaryModel,'id')"><i class="fa fa-2 fa-pencil-square-o pull-right"></i></a>
		<div class="clearfix"></div>
		</div>
		<div class="diarytext" data-dojo-type="dojox/mvc/Output" data-dojo-props="value:at(DiaryModel,'content')">
			${this.value}
		</div>
	</div>


<?php
endif;
?>

