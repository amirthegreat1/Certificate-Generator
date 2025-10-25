<?php
    include("conn.php");
    $id = $_GET['id'];
    $sql = "DELETE from all_certificates where ID = '$id'";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("location: ShowAllCertificates.php");
            exit();
    
?>