<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$forms = [1, 2, 3, 4];
$data = [];

foreach ($forms as $form) {
    $sql = "SELECT id, first_name, last_name, admission_number FROM students WHERE form = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $form);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows .= '<tr>';
            $rows .= '<td>' . htmlspecialchars($row['id']) . '</td>';
            $rows .= '<td>' . htmlspecialchars($row['first_name']) . '</td>';
            $rows .= '<td>' . htmlspecialchars($row['last_name']) . '</td>';
            $rows .= '<td>' . htmlspecialchars($row['admission_number']) . '</td>';
            $rows .= '<td><button class="btn btn-danger delete-btn" data-id="' . htmlspecialchars($row['id']) . '" data-name="' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '">Delete</button></td>';
            $rows .= '</tr>';
        }
    } else {
        $rows = '<tr><td colspan="5">No students found</td></tr>';
    }

    $data["form$form"] = $rows;
    $stmt->close();
}

echo json_encode($data);

$conn->close();
?>
