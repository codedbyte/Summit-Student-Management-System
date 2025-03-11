<?php
include '../php/db_connect.php';

$query = "SELECT id, first_name, last_name, admission_number, form FROM students";
$result = $conn->query($query);

$students = [
    'form1' => [],
    'form2' => [],
    'form3' => [],
    'form4' => [],
];

while ($row = $result->fetch_assoc()) {
    $students['form' . $row['form']][] = $row;
}

echo json_encode($students);
?>
