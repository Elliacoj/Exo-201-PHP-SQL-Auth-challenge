<?php
require_once "include.php";

if(isset($_POST['username'], $_POST['password'])) {
    $username = strip_tags(trim($_POST['username']));
    $password = strip_tags(trim($_POST['password']));

    checkpassword($username, $password);
}

function checkpassword(string $username, string $userpassword) {
    $db = DB::getInstance();

    $search = $db->prepare("SELECT password FROM user WHERE username = '$username'");
    $state = $search->execute();

    if($state) {
        $passwordDb = $search->fetch();

        if($passwordDb['password'] === $userpassword) {
            $_SESSION['pseudo'] = $username;
            $_SESSION['password'] = $userpassword;
            header("location: read.php");
        }
        else {
            header('location:login.php?error=1');
        }
    }
}