<?php

/* CONFIG, MODIFY ONLY HERE */
const BASE_URL = '/Blog/pages/';
const TITLE = 'Blog du lapin blanc';
const DESCRIPTION = 'Car manger des carottes est tout un art !';
/* CONFIG, MODIFY ONLY HERE */

// load required dependencies
require __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ .'/../generated-conf/config.php';

// static variables
const LOGIN_PAGE = BASE_URL .'login/login.php';

// dynamically load all API files
$files = glob( __DIR__ .'/*.php');
foreach ($files as $file) {
    if (!str_ends_with($file, 'mainloader.php')) {
        require_once($file);
    }
}

// utils functions
function url ($page) {
    return BASE_URL . $page;
}