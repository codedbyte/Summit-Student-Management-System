<?php
include('db_connect.php'); // Include your database connection file

// Define grade points
$grade_points = [
    'A' => 12,
    'B' => 10,
    'C' => 7,
    'D' => 4,
    'E' => 1
];

// Initialize arrays to store total points and counts for each form
$form_totals = ['form1' => 0, 'form2' => 0, 'form3' => 0, 'form4' => 0];
$form_counts = ['form1' => 0, 'form2' => 0, 'form3' => 0, 'form4' => 0];

// Fetch the latest year, term, and exam data for each form
$query = "SELECT form, grade, COUNT(*) as count
          FROM academics
          WHERE year = (SELECT MAX(year) FROM academics)
          AND term = (SELECT MAX(term) FROM academics WHERE year = (SELECT MAX(year) FROM academics))
          AND exam = (SELECT MAX(exam) FROM academics WHERE year = (SELECT MAX(year) FROM academics) AND term = (SELECT MAX(term) FROM academics))
          GROUP BY form, grade";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $form = $row['form'];
    $grade = $row['grade'];
    $count = $row['count'];

    // Calculate total points for each form
    if (isset($grade_points[$grade])) {
        $form_totals[$form] += $grade_points[$grade] * $count;
        $form_counts[$form] += $count;
    }
}

// Calculate average points for each form
$form_averages = [];
foreach ($form_totals as $form => $total_points) {
    $form_averages[$form] = ($form_counts[$form] > 0) ? $total_points / $form_counts[$form] : 0;
}

// Return the average points as JSON
echo json_encode($form_averages);

$conn->close();
?>
