<?php
include_once("conn.php");
$email = $_SESSION['email'];
$otp = $_POST['OTP'];
$sql = "SELECT * from otp_table where email = '$email' and otp = '$otp'";
$result = mysqli_query($conn , $sql);
$row = mysqli_fetch_row($result);
if(isset($row)){
    // Use a prepared statement to update the Verification status
    $sql = "UPDATE data SET Verification = '1' WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        // The update was successful
        echo "User marked as verified.";
    } else {
        // An error occurred
        echo "Error updating user verification: " . $stmt->error;
    }

    $stmt->close();
     header("location: finalform.php?verify=success");
}else{
    header("location: Verify.php?verify=failed");
}
?>



