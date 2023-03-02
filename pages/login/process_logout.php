<?php

require '../../api/mainloader.php';

destroySession();

$ref = $_SERVER['HTTP_REFERER'] ?? url('index.php');
header('Location: ' . $ref);
exit('OK');