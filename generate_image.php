
<!DOCTYPE html>
<html lang="en"  lang="ar">
<?php
        include_once("conn.php");
        if($_SESSION['email']=="" or $_SESSION['password']=="")
            {
                
                header("location: Login.php?logout=done");
            }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo_1/style.css">
    <title>Certificate</title>
</head>
<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: rgb(0,153,153);
        }
        img {
            max-width: 100%;
            max-height: 100%;
        }
        .redirect-button {
        border: none;
        outline: none;
        padding: 10px;
        border-radius: 10px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 5px; /* Add spacing between buttons */
    }

    /* Style for the red button */
    .red-button {
        background-color: red;
        color: #fff;
    }

    /* Style for the primary button */
    .primary-button {
        background-color: royalblue;
        color: #fff;
    }

    /* Style for the success button */
    .success-button {
        background-color: green;
        color: #fff;
    }

    /* Style for the danger button */
    .danger-button {
        background-color: red;
        color: #fff;
    }
    footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: rgb(0,153,153);
        padding: 0px 0;
        text-align: center;
    }
    </style>
<body>
    <!-- Save to DataBase -->
    <?php
        
        $name=$_POST["name"];
        $Course_Name=$_POST["coursename"];
        $courseDuration = $_POST["duration"];
        $nationalID = $_POST["ID"];
        $issueDate = $_POST["issuedate"];
        $birthDate = $_POST["Bdate"];
        $Certificate = 'images/' . $nationalID . '.jpg';
        $sql = "INSERT INTO all_certificates (name , Course_Name, Birth_Date, Issue_Date, National_ID, Course_Duration, Certificate)
        VALUES ('$name', '$Course_Name' , '$birthDate', '$issueDate', '$nationalID', '$courseDuration', '$Certificate')";
        mysqli_query($conn, $sql); 
    ?>
    <!-- Insert To pic -->
    <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                error_reporting(E_ERROR | E_PARSE);
                ini_set('display_errors', 'off'); // turn off errors related to the gd-farsi library
                include('php-gd-farsi-master/FarsiGD.php');
                $gd = new FarsiGD();
                $name = $gd->persianText($_POST["name"], 'fa', 'normal');
                $CourseName = $gd->persianText($_POST["coursename"], 'fa', 'normal');
                $Bdate = $gd->persianText($_POST["Bdate"], 'fa', 'normal');
                $issuedate = $gd->persianText($_POST["issuedate"], 'fa', 'normal');
                $ID = $_POST["ID"];
                $duration = $gd->persianText($_POST["duration"], 'fa', 'normal');

                // Load the image
                $image = imagecreatefromjpeg('homa.jpg');

                // Define the text color
                $textColor = imagecolorallocate($image, 0, 0, 0);
                $textColor2 = imagecolorallocate($image, 241, 210, 94);

                // Define the font size (in pixels)
                $fontSize = 70;
                $fontSize2 = 90;

                // Define the path to your TrueType font file
                $fontFile =  __DIR__. '/FreeFarsi.ttf'; // Adjust the path to match your setup

                // Define the data you want to encode in the QR code
                $data = "localhost/images/" . $ID . ".jpg"; // Replace with the URL to your certificate page

                // Create the URL for the API request
                $apiUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($data);
                // Load the QR code image from the API
                $qrCodeImage = imagecreatefrompng($apiUrl);


                // Define the positions to insert the text
                $xName = 550;
                $yName = 950;
                $xBdate = 665;
                $yBdate = 1050;
                $xIssuedate = 550;
                $yIssuedate = 1860;
                $xID = 1730;
                $yID = 1050;
                $xDuration = 750;
                $yDuration = 1740;
                $xCourseName = 300;
                $yCourseName = 1550;    
                $xQRCode = 30; 
                $yQRCode = 3040; 
                // Define the size of the QR code
                $qrCodeWidth = 300;
                $qrCodeHeight = 300;

                // Insert the variables into the image using TrueType font
                imagettftext($image, $fontSize, 0, $xName, $yName, $textColor, $fontFile, $name);
                imagettftext($image, $fontSize, 0, $xBdate, $yBdate, $textColor, $fontFile, $Bdate);
                imagettftext($image, $fontSize, 0, $xIssuedate, $yIssuedate, $textColor, $fontFile, $issuedate);
                imagettftext($image, $fontSize, 0, $xID, $yID, $textColor, $fontFile, $ID);
                imagettftext($image, $fontSize, 0, $xDuration, $yDuration, $textColor, $fontFile, $duration . " Hrs");
                imagettftext($image, $fontSize2, 0, $xCourseName, $yCourseName, $textColor2, $fontFile, $CourseName);
                imagecopyresampled($image, $qrCodeImage, $xQRCode, $yQRCode, 0, 0, $qrCodeWidth, $qrCodeHeight, imagesx($qrCodeImage), imagesy($qrCodeImage));

                // Generate filename With Melli Code
                $Filename = 'images/' . $ID . '.jpg';

                // Save the modified image with the random filename
                imagejpeg($image, $Filename);

                // Free up memory
                imagedestroy($image);
                imagedestroy($qrCodeImage);
        ?>
        <?php
            function is_valid_melli_code($code) {
                // Check the length of the national ID
                if (strlen($code) !== 10)
                    return false;
                
                // Check the validity of the control digit
                $check = (int) $code[9];
                $sum = 0;
                for ($i = 0; $i < 9; $i++) {
                    $sum += (int) $code[$i] * (10 - $i);
                }
                $remainder = $sum % 11;
                
                if (($remainder < 2 && $check == $remainder) || ($remainder >= 2 && $check == (11 - $remainder)))
                    return true;
                
                return false;
            }
            echo '<img src="images/' . $ID . '.jpg" alt="Result Image">';
            
    ?>
    <div>

    </div>
    <footer>
        <a href="images/<?php echo $ID; ?>.jpg" download class="">
        <label class="btn redirect-button danger-button">Download</label></a>
        <button class="btn redirect-button primary-button" onclick="redirectToShowAllCertificates()">Show</button>
        <button class="btn redirect-button success-button" onclick="redirectToFinalform()">New certificate</button>
        <button class="btn redirect-button primary-button" onclick="redirectToLogout()">Logout</button>
</footer>
</body>    
<script>
    function redirectToShowAllCertificates() {
        window.location.href = 'ShowAllCertificates.php';
    }

    function redirectToFinalform() {
        window.location.href = 'Finalform.php';
    }

    function redirectToLogout() {
        window.location.href = 'Logout.php';
    }
</script>
