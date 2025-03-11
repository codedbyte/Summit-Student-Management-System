<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$searchQuery = $_POST['search_query'] ?? '';
$gender = $_POST['gender'] ?? '';
$form = $_POST['form'] ?? '';

// Prepare SQL query
$sql = "SELECT * FROM students WHERE 1=1";

if (!empty($searchQuery)) {
    $sql .= " AND (admission_number LIKE ? OR first_name LIKE ? OR last_name LIKE ?)";
}

if (!empty($gender)) {
    $sql .= " AND gender = ?";
}

if (!empty($form)) {
    $sql .= " AND form = ?";
}

$stmt = $conn->prepare($sql);

// Initialize parameters and types
$params = [];
$types = '';

if (!empty($searchQuery)) {
    $searchQuery = "%$searchQuery%";
    $params[] = $searchQuery; // admission_number
    $params[] = $searchQuery; // first_name
    $params[] = $searchQuery; // last_name
    $types .= 'sss'; // Types for admission_number, first_name, last_name
}

if (!empty($gender)) {
    $params[] = $gender;
    $types .= 's'; // Type for gender
}

if (!empty($form)) {
    $params[] = $form;
    $types .= 's'; // Type for form
}

// Check if there are types to bind
if ($types) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Admission Number</th>
                    <th>Gender</th>
                    <th>Form</th>
                </tr>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['first_name']) . "</td>
                <td>" . htmlspecialchars($row['last_name']) . "</td>
                <td>" . htmlspecialchars($row['admission_number']) . "</td>
                <td>" . htmlspecialchars($row['gender']) . "</td>
                <td>" . htmlspecialchars($row['form']) . "</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<div class='no-results'>No results found for your query.</div>";
}

$stmt->close();
$conn->close();
?>
