<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve username and password from POST request
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Debugging: Ensure values are received
    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Username or Password cannot be empty']);
        exit;
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify the result
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the stored password hash matches the provided password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo json_encode(['status' => 'success', 'username' => $user['username']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Incorrect username or password']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Incorrect username or password']);
    }

    $stmt->close();
    $conn->close();
}
?>
