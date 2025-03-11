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

// Check connection and exit if it fails
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// Query to get all students
$sql = "SELECT first_name, last_name, dob, gender, email, phone, address, admission_number, form, comments FROM students";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    echo json_encode(["status" => "success", "students" => $students]);
} else {
    echo json_encode(["status" => "error", "message" => "No students found."]);
}

$conn->close();
?>
