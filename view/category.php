<?php
if($articles):
?>

<div class="ipModuleAdministrators ipsModuleAdministrators edit">
    <div class="_menu">
    <h3>Category</h3>
    <hr>
       <?php echo $articles;?>
    </div>
    <br /><br />
    <?php
    if($form):
    ?>
	<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
		<h2>Create a New Category</h2>
		<hr>
		<?php echo $form->render(); ?>
	</div>
	<?php
	endif;
	?>

</div>
<?php
endif;
?>

