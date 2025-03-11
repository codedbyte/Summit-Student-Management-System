<?php
// fetch-students.php
// Database connection (replace with your own credentials)
$conn = new mysqli("localhost", "root", "", "student_management");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students from the database
$sql = "SELECT admission_number, first_name, last_name, form FROM students";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($students);

$conn->close();
?>
