<?php

$routes['article{/postid}'] = array(
    'plugin' => 'Diary',
    'controller' => 'SiteController',
    'action' => 'read',
    'name'=>'article',
    'where' => array(
        'postid' => '\d+',
    )
);
