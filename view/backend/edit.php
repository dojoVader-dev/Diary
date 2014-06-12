<!-- Parent Top -->
<div class="col-lg-12 col-md-12 col-xs-12">

<div id="diarytitle">
<input type="text" value="<?php echo $data['title'];?>" />
</div>
<div class="pull-left" id="diaryrte">
<textarea id="ckeditor" name="ckeditor">
<?php echo $data['content'];?>
</textarea>

</div>
<div id="diarysetting" class="pull-right">
<h2>Select Category for Article</h2>
<select class="form-control">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>


<h2>Article Status</h2>
<select class="form-control">
  <?php foreach($categories as $value=>$id):?>
  <option value="<?php echo $id?>"><?php echo $value ?></option>
  <?php endforeach?>
</select>
<br />
<input class="btn btn-default" type="submit" value="Update">
</div>


</div>
<?php
ipAddJsContent('ckeditor',"jQuery(document).ready(function(){
	//Buhahahahahaha Replace CKEditor
	CKEDITOR.replace( 'ckeditor');
});")
?>
<!-- Parent Top -->