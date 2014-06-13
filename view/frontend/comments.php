
<h1>Comments</h1>
<hr>
<?php

foreach ($data as $key=>$comment): 
?>
<div>
<small>Author (<?php echo $comment['author'] ?>) said:</small>
<p><?php echo $comment['content'] ?></p>
<div class="clearfix"></div>	
</div>
 

<?php
endforeach;
?>