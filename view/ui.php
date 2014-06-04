<?php
if($articles):
?>

<div class="ipModuleAdministrators ipsModuleAdministrators edit">
    <div class="_menu">
       <?php echo $articles;?>
    </div>
    <br /><br />
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

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

