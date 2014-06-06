<!-- Parent Top -->
<div class="col-lg-12 col-md-12 col-xs-12">
<form <?php echo $form->getClassesStr(); ?> <?php echo $form->getAttributesStr(); ?> method="<?php echo $form->getMethod(); ?>" action="<?php echo $form->getAction(); ?>" enctype="multipart/form-data">
<div id="diarytitle">
<?php echo $form->getField('title')->getLabel();?>
<?php echo $form->getField('title')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);?>
</div>
<div class="pull-left" id="diaryrte">
<?php echo $form->getField('content')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN); ?>

</div>
<div id="diarysetting" class="pull-right">
<h2>Select Category for Article</h2>
<?php
echo $form->getField('category_id')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN);
?>


<h2>Article Status</h2>
<?php echo $form->getField('status')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN); ?>
<br />
<?php echo $form->getField('create')->render($this->getDoctype(), \Ip\Form::ENVIRONMENT_ADMIN); ?>
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
	CKEDITOR.replace( 'content');
});")
?>

<!-- Parent Top -->