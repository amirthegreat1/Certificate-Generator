<?php
include_once("conn.php");
include_once("OTP.php");

$email = $_POST['email'];
$password = $_POST['password'];
//data Table
$sql = "SELECT * FROM data WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//otp Table
$sql1 = "SELECT * from otp_table ";
$result1 = mysqli_query($conn , $sql1);
$row1 = mysqli_fetch_row($result1);
$Code = $row1[2];

if ($row) {
    if ($row['Verification'] == 0) {
        // User not verified

        // Generate OTP
        $otp = generateOTP();

        // Check if the user already has an OTP
        if ($row1) {
            $sql2 = "UPDATE otp_table SET otp = '$otp' WHERE email = '$email'";
            mysqli_query($conn, $sql2);
        } else {
            // Insert a new OTP for the user
            $sql3 = "INSERT INTO otp_table (email, otp, timestamp) VALUES ('$email', '$otp', NOW())";
            mysqli_query($conn, $sql3);
        }

        // Redirect to the verification page
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("location: Verify.php");
    } elseif ($row['Verification'] == 1) {
        // User already verified
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header("location: finalform.php");
    } else {
        // Other status, handle accordingly
        header("location: login.php?login=fail");
    }
} else {
    // User not found
    header("location: login.php?login=fail");
}
?>
<!-- SMS -->
<?php
$url = "https://ippanel.com/services.jspd";

$rcpt_nm = array($phone);
$param = array(
    'uname' => 'mmzenhari',
    'pass' => '70127074aA',
    'from' => '5000125475',
    'message' => 'کد تایید شما: ' . $code,
    'to' => json_encode($rcpt_nm),
    'op' => 'send'
);

$handler = curl_init($url);
curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
$response2 = curl_exec($handler);

$response2 = json_decode($response2);
$res_code = $response2[0];
$res_data = $response2[1];

echo $res_data;
?>
