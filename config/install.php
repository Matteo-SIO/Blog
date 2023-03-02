<?php

/* MODIFY HERE ONLY */
const ADMIN_EMAIL = 'admin@company.com';
const ADMIN_DISPLAY = 'Admin';
const ADMIN_PASSWORD = 'admin';

const ROLE_DISPLAY_ADMIN = 'Admin';
const ROLE_DISPLAY_MODERATOR = 'Modérateur';
const ROLE_DISPLAY_WRITER = 'Rédacteur';
/* MODIFY HERE ONLY */


/* Danger zone */
if (php_sapi_name() !== 'cli')  {
    die('This script can only be run from the command line');
}

use Blog\Role;
use Blog\User;
use Blog\UserQuery;

require '../api/mainloader.php';

$adminRole = new Role();
$adminRole->setDisplay(ROLE_DISPLAY_ADMIN);
$adminRole->setCanAdministrate(true);
$adminRole->setCanmoderate(true);
$adminRole->setCanWrite(true);
$adminRole->save();

$moderatorRole = new Role();
$moderatorRole->setDisplay(ROLE_DISPLAY_MODERATOR);
$moderatorRole->setCanAdministrate(false);
$moderatorRole->setCanmoderate(true);
$moderatorRole->setCanWrite(true);
$moderatorRole->save();

$writerRole = new Role();
$writerRole->setDisplay(ROLE_DISPLAY_WRITER);
$writerRole->setCanAdministrate(false);
$writerRole->setCanmoderate(false);
$writerRole->setCanWrite(true);
$writerRole->save();

$user = new User();
$user->setEmail(ADMIN_EMAIL);
$user->setPassword(password_hash(ADMIN_PASSWORD, PASSWORD_DEFAULT));
$user->setDisplay(ADMIN_DISPLAY);
$user->setRolesObj($adminRole);
$user->save();
