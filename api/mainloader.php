<?php

require __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ .'/../generated-conf/config.php';

const BASE_URL = '/Blog/pages/';
const LOGIN_PAGE = 'login';

const TITLE = 'Blog du lapin blanc';
const DESCRIPTION = 'Car manger des carottes est tout un art !';

$files = glob( __DIR__ .'/*.php');
foreach ($files as $file) {
    if (!str_ends_with($file, 'mainloader.php')) {
        require_once($file);
    }
}

function url ($page) {
    return BASE_URL . $page;
}