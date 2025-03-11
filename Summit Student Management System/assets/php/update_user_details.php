<?php
session_start();
require_once 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Retrieve form data
$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$phone_number = $_POST['phone_number'] ?? '';
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Check if new passwords match
if ($new_password && $new_password !== $confirm_password) {
    echo json_encode(['status' => 'error', 'message' => 'New passwords do not match.']);
    exit;
}

// Fetch current user data
$stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$current_user = $result->fetch_assoc();
$stmt->close();

if ($current_password && !password_verify($current_password, $current_user['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Current password is incorrect.']);
    exit;
}

// Prepare the update query
$query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, phone_number = ?";

if ($new_password) {
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $query .= ", password = ?";
    $stmt = $conn->prepare($query . " WHERE id = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone_number, $new_password_hashed, $user_id);
} else {
    $stmt = $conn->prepare($query . " WHERE id = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Prepare statement failed: ' . $conn->error]);
        exit;
    }
    $stmt->bind_param("ssssi", $firstname, $lastname, $email, $phone_number, $user_id);
}

// Execute the query
if ($stmt->execute()) {
    $_SESSION['username'] = $username; // Update session with new username if needed
    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update profile: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
