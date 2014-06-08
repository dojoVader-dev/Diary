<?php
use Plugin\Diary\Helper;
foreach($data as $post):?>
  <div class="col-lg-8 col-lg-offset-2">
    <h1><?php echo $post['title'];?></h1>

					<p><bd>January 18, 2014</bd></p>

					<p>
					<?php echo $post['content']?>
					</p><hr/>
</div>

<?php endforeach;?>
<div class="clearfix"></div>

<!-- Pagination -->
<?php if ($totalPages > 1) { ?>
<?php

?>
    <ul class="pagination">
        <?php if ($currentPage > 1) { ?>
            <li><a href="<?php echo Helper::setDiaryUrl(array("current"=>$currentPage - 1));?>" class="ipsAction" data-method="init" data-params="<?php echo escAttr(json_encode(array('page' => $currentPage - 1))) ?>">&laquo;</a></li>
        <?php } else { ?>
            <li class="disabled"><a href="#">&laquo;</a></li>
        <?php } ?>

        <?php foreach ($pages as $page) { ?>
            <?php if (is_numeric($page)) { ?>
                <li <?php if ($page == $currentPage) { ?>class="active"<?php } ?>><a href="<?php echo Helper::setDiaryUrl(array("current"=>$page))?>" class="ipsAction" data-method="init" data-params="<?php echo esc(json_encode(array('page' => $page))) ?>"><?php echo esc($page) ?></a></li>
            <?php } elseif (isset($page['page'])) { ?>
                <li <?php if ($page['page'] == $currentPage) { ?>class="active"<?php } ?>><a href="<?php echo Helper::setDiaryUrl(array("current"=>$page['page']))?>" class="ipsAction" data-method="init" data-params="<?php echo esc(json_encode(array('page' => $page['page']))) ?>"><?php echo esc(isset($page['text']) ? $page['text'] : $page['page']) ?></a></li>
            <?php } ?>
        <?php } ?>

        <?php if ($currentPage < $totalPages) { ?>
            <li><a href="<?php echo Helper::setDiaryUrl(array("current"=>$currentPage + 1))?>" class="ipsAction" data-method="init" data-params="<?php echo escAttr(json_encode(array('page' => $currentPage + 1))) ?>">&raquo;</a></li>
        <?php } else { ?>
            <li class="disabled"><a href="#">&raquo;</a></li>
        <?php } ?>
    </ul>
<?php } ?>