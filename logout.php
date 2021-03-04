<?php
require_once 'include.php';

if(isset($_SESSION['pseudo'], $_SESSION['password'])) {
    $_SESSION = array();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    session_destroy();
    header("location: read.php?post=off");
}

