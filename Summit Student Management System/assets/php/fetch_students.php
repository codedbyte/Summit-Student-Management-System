<?php
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "student_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form from query parameter
$form = $_GET['form'];

// Fetch students based on form
$sql = "SELECT admission_number, CONCAT(first_name, ' ', last_name) AS name FROM students WHERE form = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $form);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

// Return JSON response
echo json_encode($students);

$conn->close();
?>
