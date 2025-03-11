<?php
// delete-student-action.php
// Database connection (replace with your own credentials)
$conn = new mysqli("localhost", "root", "", "student_management");

header('Content-Type: application/json');

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Check if the admission number is provided
if (isset($_POST['admission-number'])) {
    $admissionNumber = $conn->real_escape_string($_POST['admission-number']);

    // Start transaction
    $conn->begin_transaction();

    try {
        // Delete records from related tables
        $sql = "DELETE FROM attendance WHERE admission_number = '$admissionNumber'";
        $conn->query($sql);

        // Delete student record
        $sql = "DELETE FROM students WHERE admission_number = '$admissionNumber'";
        if ($conn->query($sql) === TRUE) {
            $conn->commit();
            echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
        } else {
            throw new Exception("Error deleting student record: " . $conn->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Admission number not provided']);
}
?>
