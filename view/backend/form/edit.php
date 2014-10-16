<!-- Parent Top -->
<?php
if(isset($_SESSION['notice'])):
?>
<div class="alert alert info">
    <?php echo $_SESSION['notice']['message'];

    $_SESSION['notice']=null;
    ?>

</div>
<?php endif; ?>
<div class="col-lg-12 col-md-12 col-xs-12">
<form <?php echo $form->getClassesStr(); ?> <?php echo $form->getAttributesStr(); ?> method="<?php echo $form->getMethod(); ?>" action="<?php echo $form->getAction(); ?>" enctype="multipart/form-data">
<div id="diarytitle">
<?php echo $form->getField('title')->getLabel();?>
<?php echo $form->getField('title')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);?>
</div>
<div class="pull-left" id="diaryrte">
<?php echo $form->getField('content')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN); ?>

</div>
<div id="diarysetting" class="pull-left">
<h2>Select Category for Article</h2>
<?php
echo $form->getField('category_id')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>


<h2>Article Status</h2>
<?php echo $form->getField('status')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN); ?>
<br />
<?php echo $form->getField('create')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN); ?>
<br />
</div>
<?php
echo $form->getField('aa')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>
<?php
echo $form->getField('author')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>
<?php
echo $form->getField('date')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>
<?php
echo $form->getField('modified')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>
<?php
echo $form->getField('antispam')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>
<?php
echo $form->getField('securityToken')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>
<?php
echo $form->getField('updateField')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>

</form>

</div>
<?php
ipAddJsContent('ckeditor',"jQuery(document).ready(function(){
	//Buhahahahahaha Replace CKEditor
	CKEDITOR.replace( 'content',{
    filebrowserBrowseUrl:ip.baseUrl+'Plugin/Diary/kcfinder/browse.php?opener=ckeditor&type=files',
    filebrowserImageBrowseUrl:ip.baseUrl+'Plugin/Diary/kcfinder/browse.php?opener=ckeditor&type=images',
    filebrowserFlashBrowseUrl : ip.baseUrl+'Plugin/Diary/kcfinder/browse.php?opener=ckeditor&type=flash',
    filebrowserUploadUrl : ip.baseUrl+'Plugin/Diary/kcfinder/upload.php?opener=ckeditor&type=files',
    filebrowserImageUploadUrl : ip.baseUrl+'Plugin/Diary/kcfinder/upload.php?opener=ckeditor&type=images',
    filebrowserFlashUploadUrl : ip.baseUrl+'Plugin/Diary/kcfinder/upload.php?opener=ckeditor&type=flash'
});
});")
?>

<!-- Parent Top -->