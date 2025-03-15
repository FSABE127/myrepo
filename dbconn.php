<?php
    $userName = 'root';
    $serverName = '4.172.245.170';
    $password = '';
    $dBName = 'vulnerable_db';

    $conn = mysqli_connect($serverName,$userName , $password, $dBName);

    global $conn;
    if(!$conn){
        die("Not connected").mysqli_connect_error();
    }
?>