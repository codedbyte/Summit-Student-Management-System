<?php
// Set content type to JSON
header('Content-Type: application/json');

// Database credentials
$servername = "127.0.0.1";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "student_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection and exit silently if it fails
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    $conn->close();
    exit();
}

// Collect POST data
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$admissionNumber = $_POST['admission-number'];
$form = $_POST['form'];
$comments = $_POST['comments'];

// Prepare and execute SQL statement
$sql = "INSERT INTO students (first_name, last_name, dob, gender, email, phone, address, admission_number, form, comments)
VALUES ('$firstName', '$lastName', '$dob', '$gender', '$email', '$phone', '$address', '$admissionNumber', '$form', '$comments')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success", "message" => "Student registered successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

// Close the connection
$conn->close();
exit();
?>
