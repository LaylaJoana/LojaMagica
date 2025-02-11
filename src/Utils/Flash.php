<?php

function flash($key, $value = null)
{
    if (!$value) {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    }

    $_SESSION[$key] = $value;
}

function hasFlash($key)
{
    return !empty($_SESSION[$key]);
}

function setOld()
{
    unset($_SESSION['old']);
    foreach ($_POST as $key => $old) {
        $_SESSION['old'][$key] = $old;
    }
}

function old($name, $value = null)
{

    if (!$value) {
        if (!empty($_SESSION['old'][$name])) {
            $value = $_SESSION['old'][$name];
            unset($_SESSION['old'][$name]);
            return $value;
        }
        return null;
    }

    $_SESSION['old'][$name] = $value;
}
