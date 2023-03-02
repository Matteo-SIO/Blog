<?php

use Blog\RoleQuery;
use Blog\UserQuery;

require '../../api/mainloader.php';

// Require logged admin user
requireSession();
$user = getUser();
$role = $user->getRolesObj();
if (!$role || !$role->getCanAdministrate()) {
    header('Location: ' . url('index.php'));
    exit('NOT_ALLOWED');
}

// Render header
$header = new Header();
$header->setTitle("Administration");
$header->setDescription("Seulement pour les lapins les plus talentueux !");
$header->addCss('../../assets/css/style.css');
$header->render();

?>

<div id="adminUsers-block" class="adminBlock boxed">
    <h3>Utilisateurs</h3>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Display</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $page = 0;
            if (isset($_GET['users_page'])) {
                $page = $_GET['users_page'];
            }

            $users = UserQuery::create()
                ->limit(10)
                ->offset($page)
                ->find();
            foreach ($users as $user) {
                ?>
                <tr>
                    <form method="post" action="<?php echo url('admin/process_user.php'); ?>">
                        <td>
                            <?php echo $user->getId(); ?>
                            <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
                        </td>
                        <td>
                            <input name="display" value="<?php echo $user->getDisplay(); ?>">
                        </td>
                        <td><?php echo $user->getEmail(); ?></td>
                        <td>
                            <!-- select role -->
                            <select name="role">
                                <?php
                                $roles = RoleQuery::create()->find();
                                $userRole = $user->getRolesObj();

                                foreach ($roles as $role) {
                                    $selected = ($userRole && $userRole->getId() == $role->getId()) ? 'selected' : '';
                                    echo "<option value={$role->getId()} {$selected}>{$role->getDisplay()}</option>";
                                }
                                ?>
                            </select>
                        </td>

                        <td>
                            <input type="submit" name="type" value="Editer" class="link-button">
                            <input type="submit" name="type" value="Supprimer" class="link-button">
                        </td>
                    </form>
                </tr>
                <?php
            }
            ?>

            <!-- pagination -->
            <tr>
                <td colspan="5">
                    <?php
                    $usersCount = UserQuery::create()->count();
                    $pagesCount = ceil($usersCount / 10);
                    for ($i = 0; $i < $pagesCount; $i++) {
                        $startFrom = $i * 10;
                        $active = ($startFrom == $page) ? 'active' : '';
                        echo "Page: <a href='?users_page={$startFrom}' class='link-button {$active}'>{$i}</a>";
                    }
                    ?>
                </td>
        </tbody>
    </table>
</div>

<div id="adminRoles-block" class="adminBlock boxed">
    <h3>Rôles</h3>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Display</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $page = 0;
            if (isset($_GET['roles_page'])) {
                $page = $_GET['roles_page'];
            }

            $roles = RoleQuery::create()
                ->limit(10)
                ->offset($page)
                ->find();
            foreach ($roles as $role) {
                ?>
                <tr>
                    <form method="post" action="<?php echo url('admin/process_role.php'); ?>">
                        <td>
                            <?php echo $role->getId(); ?>
                            <input type="hidden" name="id" value="<?php echo $role->getId(); ?>">
                        </td>
                        <td>
                            <input name="display" value="<?php echo $role->getDisplay(); ?>">
                        </td>
                        <td>
                            <input type="checkbox" name="can_administrate" <?php echo ($role->getCanAdministrate()) ? 'checked' : ''; ?>> Administrer
                            <br />
                            <input type="checkbox" name="can_moderate" <?php echo ($role->getCanmoderate()) ? 'checked' : ''; ?>> Modérer
                            <br />
                            <input type="checkbox" name="can_write" <?php echo ($role->getCanwrite()) ? 'checked' : ''; ?>> Rédiger
                        </td>
                        <td>
                            <input type="submit" name="type" value="Editer" class="link-button">
                            <input type="submit" name="type" value="Supprimer" class="link-button">
                        </td>
                    </form>
                </tr>
                <?php
            }
            ?>

            <!-- create role -->
            <tr>
                <form method="post" action="<?php echo url('admin/process_role.php'); ?>">
                    <td></td>
                    <td>
                        <input name="display" placeholder="Display">
                    </td>
                    <td>
                        <input type="checkbox" name="can_administrate"> Administrer
                        <br />
                        <input type="checkbox" name="can_moderate"> Modérer
                        <br />
                        <input type="checkbox" name="can_write"> Rédiger
                    </td>
                    <td>
                        <input type="submit" name="type" value="Créer" class="link-button">
                    </td>
                </form>
            </tr>

            <!-- pagination -->
            <tr>
                <td colspan="5">
                    <?php
                    $rolesCount = RoleQuery::create()->count();
                    $pagesCount = ceil($rolesCount / 10);
                    for ($i = 0; $i < $pagesCount; $i++) {
                        $startFrom = $i * 10;
                        $active = ($startFrom == $page) ? 'active' : '';
                        echo "Page: <a href='?roles_page={$startFrom}' class='link-button {$active}'>{$i}</a>";
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>