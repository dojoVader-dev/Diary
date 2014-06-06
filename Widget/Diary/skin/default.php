
<div class="ipsContent">
<?php foreach($items as $post):?>
    <div class="col-lg-8 col-lg-offset-2">
    <h1><?php echo $post['title'];?></h1>

					<p><bd>January 18, 2014</bd></p>

					<p>
					<?php echo $post['content']?>
					</p><hr/>
</div>
<?php endforeach;?>
</div>
