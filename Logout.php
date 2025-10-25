<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION["email"]="";
    $_SESSION["password"]="";
    header("location: Login.php?logout=done");
?>