<?php
require_once 'db_connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Assume user ID is stored in session
    session_start();
    $user_id = $_SESSION['user_id'];

    // Fetch current user details
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if (!empty($current_password)) {
            if (password_verify($current_password, $user['password'])) {
                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                    $update_query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, phone_number = ?, password = ? WHERE id = ?";
                    $stmt = $conn->prepare($update_query);
                    $stmt->bind_param('sssssi', $firstname, $lastname, $email, $phone_number, $hashed_password, $user_id);
                } else {
                    $response['message'] = 'New password and confirm password do not match.';
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = 'Current password is incorrect.';
                echo json_encode($response);
                exit;
            }
        } else {
            $update_query = "UPDATE users SET firstname = ?, lastname = ?, email = ?, phone_number = ? WHERE id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('ssssi', $firstname, $lastname, $email, $phone_number, $user_id);
        }

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['message'] = 'Error updating profile.';
        }
    } else {
        $response['message'] = 'User not found.';
    }
}

echo json_encode($response);
?>
