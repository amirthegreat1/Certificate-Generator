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
    <form class="form" method="post" action="Check.php">
        <p class="title">Login</p>
        <p class="message">Enter your account get started.</p>
        <div class="form-group">
            <input placeholder="Email" type="email" class="form-control input" name="email" id="email">
            <span>Email</span>
        </div>
        <div class="form-group">
            <input placeholder="Password" type="password" class="form-control input" name="password">
            <span>Password</span>
        </div>
        <button class="btn btn-primary submit" type="submit">Login</button>
        <div class="text-center mt-2">
            Dont have an account? <a href="index.php">Singup</a>
    </form>
    <?php
        if(isset($_GET['register']) and $_GET['register'] == "done") {
            echo '<div class="text-success text-center mt-2">Signup was successful</div>';
    }
    ?>
     <?php
        if (isset($_GET['login']) && $_GET['login'] === 'fail') {
            echo '<p style="color: red;">Email or password is incorrect. Please try again.</p>';
        }
    ?>
    <?php
        if (isset($_GET['logout']) and $_GET['logout']=="done"){
            echo '<div class="text-danger text-center mt-2">You have been logged out . Please login again.</div>';
        }
    ?>
        </div>
</div>
<script>
    $(document).ready(function() {
        $("#email").on("input", function() {
            var email = $(this).val();
            
            if (isValidEmail(email)) {
                $(this).removeClass("is-invalid").addClass("is-valid");
            } else {
                $(this).removeClass("is-valid").addClass("is-invalid");
            }
        });

        function isValidEmail(email) {
            // Simple email validation using a regular expression
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email);
        }
    });
</script>
</body>
</html>
