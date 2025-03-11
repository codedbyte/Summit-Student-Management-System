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

// Retrieve POST data
$form = $_POST['form'];
$admission_number = $_POST['admission_number'];
$year = $_POST['year'];
$term = $_POST['term'];
$exam = $_POST['exam'];
$grade = $_POST['grade'];

// Insert academic record
$sql = "INSERT INTO academics (form, admission_number, year, term, exam, grade) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisii", $form, $admission_number, $year, $term, $exam, $grade);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
