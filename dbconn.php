<?php
    $userName = 'root';
    $serverName = 'localhost';
    $password = '';
    $dBName = 'vulnerable_db';

    $conn = mysqli_connect($serverName,$userName , $password, $dBName);

    global $conn;
    if(!$conn){
        die("Not connected").mysqli_connect_error();
    }
?>