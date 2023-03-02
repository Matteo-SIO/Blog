<?php

use Blog\Role;
use Blog\User;
use Blog\UserQuery;

require '../api/mainloader.php';

$admin = new Role();
$admin->setDisplay('Admin');
$admin->setCanAdministrate(true);
$admin->setCanmoderate(true);
$admin->setCanWrite(true);
$admin->save();

$moderator = new Role();
$moderator->setDisplay('Modérateur');
$moderator->setCanAdministrate(false);
$moderator->setCanmoderate(true);
$moderator->setCanWrite(true);
$moderator->save();

$writer = new Role();
$writer->setDisplay('Rédacteur');
$writer->setCanAdministrate(false);
$writer->setCanmoderate(false);
$writer->setCanWrite(true);
$writer->save();

$user = new User();
$user->setEmail('hello@gmail.com');
$user->setPassword(password_hash('12', PASSWORD_DEFAULT));
$user->setDisplay('Debugger');
$user->setRolesObj($admin);
$user->save();
