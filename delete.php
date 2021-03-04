<?php
require_once "include.php";

if(isset($_SESSION['pseudo'], $_SESSION['password'])) {
    $hiking = json_decode(base64_decode($_GET['hiking']));
    $hiking = strip_tags(trim($hiking));

    $search = $db->prepare("DELETE FROM hiking WHERE id = $hiking");

    $state = $search->execute();

    if($state) {
        header("location: read.php?post=ok");
    }
    else {
        header("location: read.php?post=notOk");
    }
}
else {
    header("location: login.php");
}