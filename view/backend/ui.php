<?php
if($articles):
?>
<div class="ipModuleAdministrators ipsModuleAdministrators edit">
    <div class="col-sm-3 col-xs-3 col-lg-1 col-md-1 ui-diary-left">
        <ul class="nav nav-pills nav-stacked" role="tablist" style="max-width: 300px;">
            <li class="active" role="presentation"><a href="#"><i class="fa fa-pencil-square-o fa-2x"></i><p>Articles</p></a>
            </li>
            <li role="presentation"><a href="#"><i class="fa fa-comments-o fa-2x"></i><p>Comments</p></a></li>
        </ul>
    </div>
    <div class="col-md-11 col-lg-11 col-sm-9 col-xs-9 killPadding" >
        <div class="col-md-12 col-lg-12 ui-diary-topbar">
            <div class="col-md-3 col-lg-3" style="height:inherit">
                <div class="ui-diary-articlepane">
                    <a href="#" class="pull-right"><i class="fa fa-plus-square-o "> &nbsp; Create</i></a>
                </div>
                <div class="ui-diary-articleList">
                    <?php echo $articles;?>
                </div>
            </div>
            <div class="col-lg-9 col-md-9" style="height:inherit">
                <div class="ui-diary-richtext-pane">
                    <h2 data-dojo-type='dojox/mvc/Output' id='DiaryTitle' data-dojo-props="value: at(DiaryModel, 'title')">
                    ${this.value}
                    </h2>

                </div>
                <div class="ui-diary-richtext"data-dojo-type="dojox/mvc/Output" data-dojo-props="value:at(DiaryModel,'content')">
            ${this.value}
        </div>
            </div>
        </div>
    </div>
    <?php
    endif;
    ?>