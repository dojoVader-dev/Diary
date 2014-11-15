<ul>
<?php
function getFormattedDate($data){
 
    if(!$data){
      throw new \Ip\Exception\Plugin("Invalid Argument passed to the function");
      
    }
    $dateFormat=getdate(strtotime($data));
      return sprintf("<h2>%s</h2> <h4>%d</h4>",$dateFormat['month'],$dateFormat['mday']);
  }

foreach($data as $post):?>
<li  class="ui-diary-articleList" id="post-<?php echo $post['id'] ?>">
<div id="ui-diary-calendar" class="col-md-3 col-lg-3">
  <?php echo getFormattedDate($post['date']); ?>
</div>
<div class="col-md-8 col-lg-8">
<h3><a href="#" data-articleid="<?php echo $post['id']?>" class='Diary_AjaxTitle'><?php echo $post['title'];?></a></h3>


  </div>
  <div class="clearfix"></div>
</li>

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