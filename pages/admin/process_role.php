<?php

use Blog\Role;
use Blog\RoleQuery;

require '../../api/mainloader.php';

requireSession();
$user = getUser();
$role = $user->getRolesObj();
if (!$role || !$role->getCanAdministrate()) {
    header('Location: ' . url('index.php'));
    exit('NOT_ALLOWED');
}

requirePost('display', 'type');
if (isPost('type', 'Supprimer')) {
    requirePost('id');
    $role = RoleQuery::create()->findOneById(post('id'));
    if ($role) {
        $role->delete();
    }
} else if (isPost('type', 'Editer')) {
    requirePost('id');
    $role = RoleQuery::create()->findOneById(post('id'));
    if ($role) {
        $role->setCanAdministrate(isPost('can_administrate', 'on'));
        $role->setCanModerate(isPost('can_moderate', 'on'));
        $role->setCanWrite(isPost('can_write', 'on'));
        $role->setDisplay(post('display'));
        $role->save();
    }
} else if (isPost('type', 'Créer')) {
    $role = new Role();
    $role->setCanAdministrate(isPost('can_administrate', 'on'));
    $role->setCanModerate(isPost('can_moderate', 'on'));
    $role->setCanWrite(isPost('can_write', 'on'));
    $role->setDisplay(post('display'));
    $role->save();
}

header('Location: ' . url('admin/admin.php'));
exit('OK');