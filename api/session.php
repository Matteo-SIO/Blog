<?php

/*
 * Le fonctionnement des systèmes de session:
 * * on stock l'ID de l'user pour pouvoir le retrouver
 *
 * * on stock le hash de l'user, sous forme de nouveau hash dépendant de l'id
 *   - le token diffère selon l'id et le password hashé
 *   - si le password change, le token devient invalide
 *   - impossible d'usurper un autre utilisateur
 *   - modifier session_id nécessite un token recalculé
 *
 */

use Blog\User;
use Blog\UserQuery;

function buildToken (int $id, String $hashedPass) : String {
    return password_hash($id .$hashedPass, PASSWORD_DEFAULT);
}

function verifyToken (String $id, $pass, String $token) : bool {
    return password_verify($id .$pass, $token);
}

function _setCookie (String $name, String $value, int $expire = 0) : void {
    setcookie($name, $value, $expire, '/', "", true, true);
}
function createSession (int $id, String $hashedPass) : void {
    _setCookie('isLogged', 'true');
    _setCookie('session_id', $id);
    _setCookie('session_token', buildToken($id, $hashedPass));
}

function destroySession () : void {
    _setCookie('isLogged', 'false', time() - 3600);
    _setCookie('session_id', '', time() - 3600);
    _setCookie('session_token', '', time() - 3600);
}

function getUser () : bool | User {
    if (!isset($_COOKIE['isLogged']) || !$_COOKIE['isLogged'])
        return false;
    $userBddInstance = UserQuery::create()->findOneById($_COOKIE['session_id']);
    if ($userBddInstance !== null) {
        $id = $userBddInstance->getId();
        $pass = $userBddInstance->getPassword();
        if (verifyToken($id, $pass, $_COOKIE['session_token'])) {
            return $userBddInstance;
        }
    }
    return false;
}

function isLogged () : bool {
    return getUser() !== false;
}

function requireSession () : User {
    $userInstance = getUser();
    if (!$userInstance) {
        header("Location: " .LOGIN_PAGE);
        exit();
    }
    return $userInstance;
}