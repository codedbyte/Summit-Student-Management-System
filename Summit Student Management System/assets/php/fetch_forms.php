<?php
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "student_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch distinct forms
$sql = "SELECT DISTINCT form FROM students";
$result = $conn->query($sql);

$forms = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $forms[] = $row['form'];
    }
}

// Return JSON response
echo json_encode($forms);

$conn->close();
?>
