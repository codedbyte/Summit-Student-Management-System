<?php
$servername = "127.0.0.1";
$username = "root"; // or your database username
$password = ""; // or your database password
$dbname = "student_management";

header('Content-Type: application/json');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

$first_name = $_POST['first-name'];
$last_name = $_POST['last-name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$admission_number = $_POST['admission-number'];
$form = $_POST['form'];
$comments = $_POST['comments'];

$sql = "UPDATE students SET first_name = ?, last_name = ?, dob = ?, gender = ?, email = ?, phone = ?, address = ?, form = ?, comments = ? WHERE admission_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $first_name, $last_name, $dob, $gender, $email, $phone, $address, $form, $comments, $admission_number);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
