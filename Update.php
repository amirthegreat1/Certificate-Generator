<?php
include_once("conn.php");
$id = $_GET['id'];
$name = $_POST["name"];
$Course_Name = $_POST["coursename"];
$courseDuration = $_POST["duration"];
$nationalID = $_POST["ID"];
$issueDate = $_POST["issuedate"];
$birthDate = $_POST["Bdate"];
$Certificate = 'images/' . $nationalID . '.jpg';
$sql = "UPDATE all_certificates 
        SET name = '$name',
            Course_Name = '$Course_Name',
            Birth_Date = '$birthDate',
            Issue_Date = '$issueDate',
            National_ID = '$nationalID',
            Course_Duration = '$courseDuration',
            Certificate = '$Certificate'
            WHERE id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header("location: ShowAllCertificates.php");
        exit();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

?>
