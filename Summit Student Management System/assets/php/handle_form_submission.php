<?php
require 'db_connect.php'; // Include your database connection file

header('Content-Type: application/json');

// Collect POST data
$form = $_POST['form'];
$admission_number = $_POST['admission_number'];
$year = $_POST['year'];
$term = $_POST['term'];
$exam = $_POST['exam'];
$grade = $_POST['grade'];

// Prepare SQL statement
$sql = "INSERT INTO academics (form, admission_number, year, term, exam, grade)
VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $form, $admission_number, $year, $term, $exam, $grade);

$response = [];

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Grades submitted successfully.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
