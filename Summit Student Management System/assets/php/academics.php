<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form = $conn->real_escape_string($_POST['form']);
    $admission_number = $conn->real_escape_string($_POST['admission_number']);
    $year = $conn->real_escape_string($_POST['year']);
    $term = $conn->real_escape_string($_POST['term']);
    $exam = $conn->real_escape_string($_POST['exam']);
    $grade = $conn->real_escape_string($_POST['grade']);

    $sql = "INSERT INTO academics (form, admission_number, year, term, exam, grade)
            VALUES ('$form', '$admission_number', '$year', '$term', '$exam', '$grade')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
