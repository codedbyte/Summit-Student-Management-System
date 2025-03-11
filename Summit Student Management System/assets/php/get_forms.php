<?php
require 'db_connect.php'; // Assuming you have a db_connect.php file for the database connection

header('Content-Type: application/json');

// Create SQL to get distinct forms
$sql = "SELECT DISTINCT form FROM students ORDER BY form";
$result = $conn->query($sql);

$forms = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $forms[] = $row['form'];
    }
}

echo json_encode($forms);

$conn->close();
?>
