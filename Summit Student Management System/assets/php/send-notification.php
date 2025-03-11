<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}

$title = $_POST['title'];
$description = $_POST['description'];
$notify_date = $_POST['notify_date'];

$sql = "INSERT INTO notifications (title, description, notify_date) VALUES ('$title', '$description', '$notify_date')";

if ($conn->query($sql) === TRUE) {
    echo "Notification created successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
