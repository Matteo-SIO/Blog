<?php

function requireInObject ($obj, ...$varargs): bool {
    foreach ($varargs as $element) {
        if (!isset($obj[$element])) return false;
    }
    return true;
}
function inPost (...$varargs) : bool {
    return requireInObject($_POST, ...$varargs);
}

function inGet (...$varargs) : bool {
    return requireInObject($_GET, ...$varargs);
}

function requirePost (...$varargs) {
    if (!inPost(...$varargs))
        throw new Error("Missing POST args");
}

function requireGet (...$varargs) {
    if (!inGet(...$varargs))
        throw new Error("Missing GET args");
}

function post ($key) {
    return $_POST[$key];
}

function get ($key) {
    return $_GET[$key];
}

function hashedPost ($key): string {
    return password_hash(post($key), null);
}

function isPost ($key, $value) : bool {
    return post($key) === $value;
}

function isGet ($key, $value) : bool {
    return get($key) === $value;
}