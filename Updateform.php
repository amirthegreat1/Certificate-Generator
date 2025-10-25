<?php
    include("conn.php");
    $id = $_GET['id'];
    $sql = "SELECT * from all_certificates where ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Certificate Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">

    <style>
                    /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }
            body{
            background-color: rgb(0,153,153);
        }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }
        /* Add custom styles here if needed */
        .form {
            max-width: 350px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 20px;
            background-color: #fff;
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
        <form class="form" method="post" action="Update.php?id=<?php echo $row[0]; ?>" accept-charset="UTF-8">
            <p class="title">Register</p>
            <p class="message">Signup now and get full access to our app.</p>  
            <div class="form-group">
                <input placeholder="<?php echo $row[1] ?>" type="text" class="form-control input" name="name">
                <span>name</span>
            </div>
            <div class="form-group">
                <input placeholder="<?php echo $row[2] ?>" type="text" class="form-control input" name="coursename">
                <span>Course Name</span>
            </div>
            <div class="form-group">
                <input placeholder="<?php echo $row[3] ?>" type="date" class="form-control input" name="Bdate" id="date">
                <span>Birth Date</span>
            </div>
            <div class="form-group">
                <input placeholder="<?php echo $row[4] ?>" type="date" class="form-control input" name="issuedate">
                    <span>Issue Date</span>
                </div>
                <div class="form-group">
                    <input placeholder="<?php echo $row[5] ?>" type="number"  inputmode="numeric" class="form-control" name="ID" id="nationalID" >
                    <span>National ID</span>
                </div>
                <div class="form-group">
                    <input placeholder="<?php echo $row[6] ?>" type="number"  inputmode="numeric" class="form-control input" name="duration">
                    <span>Course Duration</span>
                </div>
                <button class="btn btn-primary submit" type="submit">Submit</button>
        </form>
    </div>

<script>
        $(document).ready(function() {
        $("#nationalID").on("input", function() {
            var nationalID = $(this).val();
            
            if (is_valid_melli_code(nationalID)) {
            $(this).removeClass("is-invalid").addClass("is-valid");
            } else {
            $(this).removeClass("is-valid").addClass("is-invalid");
            }
        });

        function is_valid_melli_code(code) {
            // Check the length of the national ID
            if (code.length !== 10)
            return false;

            // Check the validity of the control digit
            var check = parseInt(code[9]);
            var sum = 0;
            for (var i = 0; i < 9; i++) {
            sum += parseInt(code[i]) * (10 - i);
            }
            var remainder = sum % 11;

            if ((remainder < 2 && check == remainder) || (remainder >= 2 && check == (11 - remainder)))
            return true;

            return false;
        }
        });
</script>
<script>
    $(document).ready(function() {
        // Function to check if the National ID is valid
        function isNationalIDValid(nationalID) {
            // Implement your National ID validation logic here
            return is_valid_melli_code(nationalID);
        }

        // Function to enable or disable the Submit button based on National ID validation
        function updateSubmitButton() {
            var nationalID = $("#nationalID").val().trim();
            var isNationalIDValidFlag = isNationalIDValid(nationalID);

            if (isNationalIDValidFlag) {
                $("#submit").prop("disabled", false);
            } else {
                $("#submit").prop("disabled", true);
            }
        }

        // Attach input event listener to the National ID field
        $("#nationalID").on("input", function() {
            updateSubmitButton();
        });

        // Initially disable the Submit button
        $("#submit").prop("disabled", true);
    });
</script>
</body>
</html>
