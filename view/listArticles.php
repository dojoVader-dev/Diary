<h2>Articles</h2>
<hr />
<ul>
<?php foreach($posts as $post):?>
<li id="post-<?php echo $post['id'] ?>">
<h2><a href="#" data-articleid="<?php echo $post['id']?>" class='Diary_AjaxTitle'><?php echo $post['title'];?></a></h2>
<p><small>Author:<?php echo $post['author'];?></small></p>
<p><small>Created:<?php echo $post['date']?></small></p>

<div class="btn-group btn-group-sm">
  <button type="button" class="btn btn-default"><a href="<?php echo ipActionUrl(array('aa'=>'Diary.edit','id'=>$post['id'])); ?>">Edit</a></button>
  <button type="button" class="btn btn-default ajaxLinkDelete" data-id="<?php echo $post['id']?>" ><a href="<?php echo ipActionUrl(array('aa'=>'Diary.delete','id'=>$post['id'])); ?>">Delete</a></button>

  </div>
</li>
<hr />
<?php endforeach;?>
</ul>
<div id="DiaryDialog" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Small modal</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
         <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
      </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
  </div>