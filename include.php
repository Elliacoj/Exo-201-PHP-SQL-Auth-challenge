<?php
session_start();
require_once "./Classes/DB.php";
require_once "./Entity/Hiking.php";
$db = DB::getInstance();