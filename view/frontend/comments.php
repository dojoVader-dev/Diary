
<h1>Comments</h1>
<hr>
<?php

foreach ($data as $key=>$comment): 
?>
<div class="col-md-12 col-lg-12 diary_comment_container">
<div class="col-md-2 col-lg-2">
	<img class="thumbnail" src="holder.js/64x64" alt="author">	
	<small><?php echo $comment['author'] ?></small>
</div>

<div class="col-lg-10 col-md-10 diary_comment">

<i class="fa fa-caret-left diary_left_arrow fa-2"></i>
<?php echo $comment['content'] ?>
<br><br>
<small><strong>	<?php echo date("F j, Y, g:i a",strtotime($comment['date'])); ?></strong></small>

</div>
<div class="clearfix"></div>
 </div>
<div class="clearfix"></div>
<?php
endforeach;
?>