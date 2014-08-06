<h2>Articles</h2>
<hr />
<ul>
<?php

foreach($data as $post):?>
<li id="post-<?php echo $post['id'] ?>">
<h2><a href="#" data-articleid="<?php echo $post['id']?>" class='Diary_AjaxTitle'><?php echo $post['title'];?></a></h2>
<p><small><strong>Author:</strong> <?php echo $post['author'];?></small></p>
<p><small><strong>Created:</strong> <?php echo $post['date']?></small></p>
<p><small><strong>Updated:</strong> <?php echo $post['modified']?></small></p>

<div class="btn-group btn-group-sm">
  <button type="button" class="btn btn-default"><a href="<?php echo ipActionUrl(array('aa'=>'Diary.edit','id'=>$post['id'])); ?>">Edit</a></button>
  <button type="button" class="btn btn-default ajaxLinkDelete" data-id="<?php echo $post['id']?>" ><a href="<?php echo ipActionUrl(array('aa'=>'Diary.delete','id'=>$post['id'])); ?>">Delete</a></button>

  </div>
</li>
<hr />
<?php endforeach;?>
</ul>
<!-- Pagination -->
<?php if ($totalPages > 1) { ?>

    <ul class="pagination">
        <?php if ($currentPage > 1) { ?>
            <li><a href="<?php echo ipActionUrl(array("aa"=>"Diary.index","current"=>$currentPage - 1))?>" class="ipsAction" data-method="init" data-params="<?php echo escAttr(json_encode(array('page' => $currentPage - 1))) ?>">&laquo;</a></li>
        <?php } else { ?>
            <li class="disabled"><a href="#">&laquo;</a></li>
        <?php } ?>

        <?php foreach ($pages as $page) { ?>
            <?php if (is_numeric($page)) { ?>
                <li <?php if ($page == $currentPage) { ?>class="active"<?php } ?>><a href="<?php echo ipActionUrl(array("aa"=>"Diary.index","current"=>$page))?>" class="ipsAction" data-method="init" data-params="<?php echo esc(json_encode(array('page' => $page))) ?>"><?php echo esc($page) ?></a></li>
            <?php } elseif (isset($page['page'])) { ?>
                <li <?php if ($page['page'] == $currentPage) { ?>class="active"<?php } ?>><a href="<?php ipActionUrl(array("aa"=>"Diary.index","current"=>$page['page']))?>" class="ipsAction" data-method="init" data-params="<?php echo esc(json_encode(array('page' => $page['page']))) ?>"><?php echo esc(isset($page['text']) ? $page['text'] : $page['page']) ?></a></li>
            <?php } ?>
        <?php } ?>

        <?php if ($currentPage < $totalPages) { ?>
            <li><a href="<?php echo ipActionUrl(array("aa"=>"Diary.index","current"=>$currentPage + 1))?>" class="ipsAction" data-method="init" data-params="<?php echo escAttr(json_encode(array('page' => $currentPage + 1))) ?>">&raquo;</a></li>
        <?php } else { ?>
            <li class="disabled"><a href="#">&raquo;</a></li>
        <?php } ?>
    </ul>
<?php } ?>
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