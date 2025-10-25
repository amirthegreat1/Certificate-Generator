<?php
include_once("conn.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Add custom styles here if needed */
        body{
            background-color: rgb(0,153,153);
        }
        .form {
            max-width: 350px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 20px;
            background-color: #c2d0b7;;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            color: rgba(88, 87, 87, 0.822);
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
        }
        .input {
            padding: 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
            width: 100%;
        }
        .input + span {
            color: grey;
            font-size: 0.9em;
        }
        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .submit:hover {
            background-color: rgb(56, 90, 194);
        }
    </style>
</head>
<body>
<div class="container">
    <form class="form" method="post" action="CheckOTP.php">
        <p class="title">Verification</p>
        <p class="message">Please Verify your account</p>
        <div class="form-group">
            <input placeholder="####" type="text" class="form-control input" name="OTP" id="OTP">
            <span>Enter OTP</span>
        </div>
        <button class="btn btn-primary submit" type="submit">verify</button>
        <div class="text-center mt-2">
        <?php
        if (isset($_GET['verify']) && $_GET['verify'] == 'failed') {
            echo '<div class="text-danger text-center mt-2">Inccorect code . please try again.</div>';
        }
        ?>
    </form>
</div>
</body>
</html>
