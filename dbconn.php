<?php
    $userName = 'if0_38492756';
    $serverName = 'sql108.infinityfree.com';
    $password = 'Kk9HO9tmV1YKZ';
    $dBName = 'if0_38492756_vulnerable_db';

    $conn = mysqli_connect($serverName,$userName , $password, $dBName);

    global $conn;
    if(!$conn){
        die("Not connected").mysqli_connect_error();
    }
?>