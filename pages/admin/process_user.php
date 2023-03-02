<?php

use Blog\UserQuery;

require '../../api/mainloader.php';

requireSession();
$user = getUser();
$role = $user->getRolesObj();
if (!$role || !$role->getCanAdministrate()) {
    header('Location: ' . url('index.php'));
    exit('NOT_ALLOWED');
}

requirePost('id', 'display', 'type');
if (isPost('type', 'Supprimer')) {
    $user = UserQuery::create()->findOneById(post('id'));
    if ($user) {
        $user->delete();
    }
} else if (isPost('type', 'Editer')) {
    requirePost('role');
    $user = UserQuery::create()->findOneById(post('id'));
    if ($user) {
        $user->setRoleId(post('role'));
        $user->setDisplay(post('display'));
        $user->save();
    }
}

header('Location: ' . url('admin/admin.php'));
exit('OK');