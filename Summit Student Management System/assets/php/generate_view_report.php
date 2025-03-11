<?php
require('db_connect.php');

if (isset($_GET['report_type'])) {
    $report_type = $_GET['report_type'];

    switch ($report_type) {
        case 'enrollment':
            $query = "SELECT * FROM students ORDER BY form";
            break;
        case 'attendance':
            $query = "SELECT * FROM attendance ORDER BY form";
            break;
        case 'academics':
            $query = "SELECT * FROM academics ORDER BY form";
            break;
        default:
            echo "Invalid report type.";
            exit;
    }

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<table class="report-table">';
        echo '<thead><tr>';
        while ($field = $result->fetch_field()) {
            echo '<th>' . ucfirst($field->name) . '</th>';
        }
        echo '</tr></thead><tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
    } else {
        echo "No data found.";
    }
}
?>
