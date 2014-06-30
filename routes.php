<?php

$routes['article{/postid}'] = array(
    'plugin' => 'Diary',
    'controller' => 'SiteController',
    'action' => 'read',
    'where' => array(
        'postid' => '\d+',
    )
);
