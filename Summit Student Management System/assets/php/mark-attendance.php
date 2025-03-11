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

if (isset($data['students']) && is_array($data['students'])) {
    $stmt = $conn->prepare("INSERT INTO attendance (admission_number, date, status, comments, form) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($data['students'] as $student) {
        $admission_number = $student['admission_number'];
        $date = date('Y-m-d'); // Assuming we're marking attendance for today
        $status = $student['status'];
        $comments = $student['comments'];
        $form = $student['form'];
        
        $stmt->bind_param("sssss", $admission_number, $date, $status, $comments, $form);
        $stmt->execute();
    }
    
    $stmt->close();
    echo json_encode(["status" => "success", "message" => "Attendance marked successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid data provided."]);
}

$conn->close();
?>
