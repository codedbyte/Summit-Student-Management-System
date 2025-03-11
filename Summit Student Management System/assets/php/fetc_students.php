<?php
include_once 'db_connect.php';

$form = isset($_GET['form']) ? intval($_GET['form']) : 1;

$sql = "SELECT id, admission_number, first_name, last_name FROM students WHERE form = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $form);
$stmt->execute();
$result = $stmt->get_result();

$students = array();

while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($students);
?>
