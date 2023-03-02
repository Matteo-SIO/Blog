<?php

use Blog\User;
use Blog\UserQuery;

require '../../api/mainloader.php';

requirePost('type', 'ref');
if (isPost('type', 'login')) {
    requirePost('email', 'password');
    $email = post('email');
    $password = post('password');

    $user = UserQuery::create()
        ->filterByEmail($email)
        ->findOne();

    if ($user) {
        if (password_verify($password, $user->getPassword())) {
            createSession($user->getId(), $user->getPassword());

            $ref = post('ref');
            if (!$ref) {
                $ref = url('index.php');
            }

            header('Location: ' . $ref);
            exit(post('ref'));
        }
    }

    exit('INVALID_CREDENTIALS');
}