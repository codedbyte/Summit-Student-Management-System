<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$admissionNumber = $data['admission_number'];

$response = ['success' => false];

if (!empty($admissionNumber)) {
    $conn = new mysqli('localhost', 'root', '', 'student_management');

    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'error' => 'Database connection failed.']));
    }

    $stmt = $conn->prepare('SELECT first_name, last_name FROM students WHERE admission_number = ?');
    $stmt->bind_param('s', $admissionNumber);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName);

    if ($stmt->fetch()) {
        $response['success'] = true;
        $response['first_name'] = $firstName;
        $response['last_name'] = $lastName;
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
