<?php
require 'db_connect.php'; // Assuming you have a db_connect.php file for the database connection

header('Content-Type: application/json');

$form = $_GET['form'];

$sql = "SELECT admission_number, CONCAT(first_name, ' ', last_name) AS name FROM students WHERE form = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $form);
$stmt->execute();
$result = $stmt->get_result();

$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

echo json_encode($students);

$stmt->close();
$conn->close();
?>
