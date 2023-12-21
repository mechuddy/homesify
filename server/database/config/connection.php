<?php
    // get DB
    require_once "DB.php";
    // create DB obj
    $db = new DB("localhost", "root", "", "homesify");
    // create connection
    $connection = new mysqli($db->DBHost, $db->DBUser, $db->DBPassword, $db->DBName);
    // check connection
    if($connection->connect_error) {
        $msg = "Connection Error";
        die($msg);
    }
?>