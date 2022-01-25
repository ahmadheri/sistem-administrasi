<?php
session_start();

// check user logged 
function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

// check user role
function isAdmin()
{
    if ($_SESSION['role'] == 'Admin') {
        return true;
    } else {
        return false;
    }

}

function sessionExpired()
{
    // 30 is how much time do we want in minute
    // 60 is detik dalam 1 menit
    $_SESSION['expire'] = $_SESSION['start'] + (360 * 60);
}

function sessionTimeChecked()
{
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_unset();
        session_destroy();
        header('Location: ' . URLROOT . '/users/login');
    }
}
