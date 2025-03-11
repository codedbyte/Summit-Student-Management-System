<?php
// Set content type to JSON
header('Content-Type: application/json');

// Database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "student_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// Query to get all academic records
$sql = "SELECT admission_number, form, year, term, exam, grade FROM academics";
$result = $conn->query($sql);

$records = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
    echo json_encode(["status" => "success", "records" => $records]);
} else {
    echo json_encode(["status" => "error", "message" => "No records found."]);
}

$conn->close();
?>
