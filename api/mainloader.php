<?php

// load required dependencies
require __DIR__ .'/../vendor/autoload.php';
require_once __DIR__ .'/../generated-conf/config.php';

// static variables
require __DIR__ .'../../config/global.php';

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