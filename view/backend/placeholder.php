<div class="ipModuleAdministrators ipsModuleAdministrators edit">
    <div class="col-sm-3 col-xs-3 col-lg-1 col-md-1 ui-diary-left">
        <ul class="nav nav-pills nav-stacked" role="tablist" style="max-width: 300px;">
            <li class="active" role="presentation"><a href="#"><i class="fa fa-pencil-square-o fa-2x"></i><p>Articles</p></a>
            </li>
            <li role="presentation"><a href="<?php echo ipActionUrl(array("aa"=>"Diary.comment")) ?>"><i class="fa fa-comments-o fa-2x"></i><p>Comments</p></a></li>
        </ul>
    </div>
    <div class="col-md-11 col-lg-11 col-sm-9 col-xs-9 killPadding" >
       
        <div class="col-md-12 col-lg-12 killPadding articleListPane">
<div class="ipModuleGrid ipsGrid" data-gateway="<?php echo escAttr(json_encode($gateway)); ?>"></div>
</div>
</div>
</div>
