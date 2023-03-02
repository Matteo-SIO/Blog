<?php

use Blog\User;
use Blog\UserQuery;

require '../../api/mainloader.php';

requirePost('type', 'ref');
if (isPost('type', 'register')) {
    requirePost('email', 'display', 'password');

    $email = post('email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('INVALID_EMAIL');
    }

    $password = post('password');
    if (strlen($password) < 10) {
        exit('INVALID_PASSWORD');
    }
    $password = hashedPost('password');

    $display = post('display');

    $count = UserQuery::create()
        ->filterByEmail($email)
        ->filterByDisplay($display)
        ->count();

    if (!$count) {
        $user = new User();
        $user->setDisplay($display);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->save();

        createSession($user->getId(), $user->getPassword());
        header('Location: ' . post('ref'));
        exit('OK');
    }

    exit('ALREADY_EXISTS');
}