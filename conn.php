<?php
    session_start();
    $localhost= "localhost"; // Enter Database Host
    $dbuser = "root"; // Enter Database UserName
    $dbpass = ""; // Enter Database Password
    $dbname = "InsertToPic"; // Enter Database Name
    $conn = mysqli_connect($localhost, $dbuser, $dbpass, $dbname);
?>