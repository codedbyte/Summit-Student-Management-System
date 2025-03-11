<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';

    if (empty($username) || empty($email) || empty($newPassword)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ? AND email = ?");
        $stmt->bind_param("sss", $newPasswordHash, $username, $email);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update password']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or email']);
    }

    $stmt->close();
    $conn->close();
}
?>
