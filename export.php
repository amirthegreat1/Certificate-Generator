<?php
include("conn.php");

// Define the CSV file name
$filename = "certificates.csv";

// Create a file pointer
$output = fopen("php://output", "w");

// Add the CSV header row
$header = array("Name", "Course Name", "Birth Date", "Issue Date", "National ID", "Course Duration", "Certificate");
fputcsv($output, $header);

// Fetch data from the database
$sql = "SELECT * FROM all_certificates";
$result = mysqli_query($conn, $sql);

// Add data rows to the CSV
while ($row = mysqli_fetch_assoc($result)) {
    $data = array(
        $row['name'],
        $row['Course_Name'],
        $row['Birth_Date'],
        $row['Issue_Date'],
        $row['National_ID'],
        $row['Course_Duration'],
        $row['Certificate']
    );
    fputcsv($output, $data);
}

// Close the file pointer
fclose($output);

// Set the HTTP response headers to trigger the download
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");

// Terminate the script
exit();
?>
