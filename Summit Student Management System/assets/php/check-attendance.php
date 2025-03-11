<?php
// Set content type to JSON
header('Content-Type: application/json');

// Database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "student_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection and exit if it fails
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['date'])) {
    $date = $data['date'];

    // Check if attendance already exists for this date
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM attendance WHERE date = ?");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        echo json_encode(["status" => "exists", "message" => "Attendance for this date has already been submitted."]);
    } else {
        echo json_encode(["status" => "not_exists", "message" => "Attendance for this date has not been submitted yet."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid data provided."]);
}

$conn->close();
?>
