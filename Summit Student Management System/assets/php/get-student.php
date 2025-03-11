<?php
$servername = "127.0.0.1";
$username = "root"; // or your database username
$password = ""; // or your database password
$dbname = "student_management";

header('Content-Type: application/json');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$admission_number = $_GET['admission_number'];

$sql = "SELECT * FROM students WHERE admission_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $admission_number);
$stmt->execute();
$result = $stmt->get_result();

$student = $result->fetch_assoc();

echo json_encode($student);

$stmt->close();
$conn->close();
?>
