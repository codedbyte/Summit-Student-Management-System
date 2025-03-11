<?php
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "student_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

$date = $_GET['date'] ?? '';

if ($date) {
    $stmt = $conn->prepare("SELECT students.first_name, students.last_name, students.form, attendance.admission_number, attendance.status, attendance.comments 
                            FROM attendance 
                            JOIN students ON attendance.admission_number = students.admission_number 
                            WHERE attendance.date = ?");
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $attendance = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $attendance[] = $row;
        }
        echo json_encode(["status" => "success", "attendance" => $attendance]);
    } else {
        echo json_encode(["status" => "error", "message" => "No attendance records found for the selected date."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No date selected."]);
}

$conn->close();
?>
