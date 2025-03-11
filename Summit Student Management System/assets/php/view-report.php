<?php
require_once 'db_connect.php';

$category = $_GET['category'] ?? '';
$forms = $_GET['forms'] ?? '';

$formFilter = !empty($forms) ? explode(',', $forms) : [];

$query = "SELECT * FROM $category";
$params = [];
$types = '';

if ($category == 'students' || $category == 'attendance' || $category == 'academics') {
    if (!empty($formFilter)) {
        $placeholders = implode(',', array_fill(0, count($formFilter), '?'));
        $query .= " WHERE form IN ($placeholders)";
        $params = array_merge($params, $formFilter);
        $types .= str_repeat('s', count($formFilter));
    }
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'><thead><tr>";
    while ($field = $result->fetch_field()) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr></thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "No results found.";
}

$stmt->close();
$conn->close();
?>
