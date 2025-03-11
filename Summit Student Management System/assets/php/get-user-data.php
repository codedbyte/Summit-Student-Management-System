<?php
require_once 'db_connect.php';

session_start();
$response = ['success' => false];

$user_id = $_SESSION['user_id']; // Assume user ID is stored in session

$query = "SELECT firstname, lastname, email, phone_number FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $response['success'] = true;
    $response['firstname'] = $user['firstname'];
    $response['lastname'] = $user['lastname'];
    $response['email'] = $user['email'];
    $response['phone_number'] = $user['phone_number'];
} else {
    $response['message'] = 'User not found.';
}

echo json_encode($response);
?>
