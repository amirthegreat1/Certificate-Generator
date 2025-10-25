<?php
include_once("conn.php");

$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$OTP = $_SESSION['OTP'];

// Check if the email already exists
$checkEmailQuery = "SELECT * FROM data WHERE Email = '$email'";
$checkEmailResult = mysqli_query($conn, $checkEmailQuery);

if(mysqli_num_rows($checkEmailResult) > 0) {
    // Email already exists, show an error
    header("location: index.php?error=email_exists");
    exit(); // Make sure to exit after setting the header
}

// Email does not exist, proceed with the insertion
$sql = "INSERT INTO data (Email, Password, Phone, Verification) VALUES ('$email', '$password', '$phone' , '0')";
mysqli_query($conn, $sql);
mysqli_close($conn);

header("location: Login.php?register=done");
exit(); // Make sure to exit after setting the header
?>
