<?php
include '../php/db_connect.php';

$data = json_decode(file_get_contents("php://input"), true);
$studentId = $data['id'];

$query = "DELETE FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $studentId);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
