<?php

$routes['article{/articleName}'] = array(
    'plugin' => 'Diary',
    'controller' => 'SiteController',
    'action' => 'read',
    'name'=>'article',
    'where' => array(
        'articleName' => '\w.+',
    )
);
