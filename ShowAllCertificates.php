<?php
include("conn.php");
    if($_SESSION['email']=="" or $_SESSION['password']=="")
    {
        
        header("location: Logout.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
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
    <title>Document</title>
</head>
<style>
    body {
        direction : rtl;
        background-color: rgb(0,153,153);
        
    }
    .center-button {
        text-align: center;
    }

    /* Style for the button */
    .red-button {
        background-color: red;
        color: #fff;
        border: none;
        outline: none;
        padding: 10px;
        border-radius: 10px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .green-button {
        background-color: green;
        color: #fff;
        border: none;
        outline: none;
        padding: 10px;
        border-radius: 10px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .primary-button {
        background-color: rgb(0,50,225);
        color: #fff;
        border: none;
        outline: none;
        padding: 10px;
        border-radius: 10px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
</style>
<body>   
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>Course Name</th>
                        <th>Birth Date</th>
                        <th>Issue Date</th>
                        <th>National ID</th>
                        <th>Course Duration</th>
                        <th>Certificate</th>
                        <th>operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sql = "SELECT * from all_certificates ";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_row($result)) :
                    ?>
                        <tr>
                            <td><?php echo $row[1] ?></td>
                            <td><?php echo $row[2] ?></td>
                            <td><?php echo $row[3] ?></td>
                            <td><?php echo $row[4] ?></td>
                            <td><?php echo $row[5] ?></td>
                            <td><?php echo $row[6] ?></td>
                            <td><a href="<?php echo $row[7] ?>" download>Download Certificate</a></td>
                            <td>
                            <a href="UpdateForm.php?id=<?php echo $row[0]; ?>">
                                <label class="badge badge-warning">edit</label>
                            </a>
                            <a href="Delete.php?id=<?php echo $row[0]; ?>">
                                <label class="badge badge-danger">Delete</label>
                            </a>
                            </td>
                            <td>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="center-button">
    <button class="btn btn-success green-button" type="button" onclick="redirectToFinalform()">New Certificate</button>
    <button class="btn btn-danger show red-button" type="button" onclick="redirectToLogout()">Logout</button>
    <button class="btn btn-primary primary-button" type="button" onclick="downloadCSV()">Download CSV</button>
</div>
</body>
<script>
    function redirectToFinalform() {
        window.location.href = 'Finalform.php';
    }
    function redirectToLogout() {
        window.location.href = 'Logout.php';
    }
    function downloadCSV() {
        window.location.href = 'export.php';
    }
    </script>
</html>
