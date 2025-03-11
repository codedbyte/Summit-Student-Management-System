<?php
include 'db_connect.php';

$today = date('Y-m-d');

// Check if there is data for today
$check_today_query = "SELECT COUNT(*) AS count FROM attendance WHERE date = '$today'";
$check_today_result = mysqli_query($conn, $check_today_query);
$check_today_row = mysqli_fetch_assoc($check_today_result);
$today_count = $check_today_row['count'];

// Determine the date to use (today or the most recent date)
if ($today_count > 0) {
    $date_to_use = $today;
} else {
    // Get the most recent date in the attendance table
    $latest_date_query = "SELECT MAX(date) AS latest_date FROM attendance";
    $latest_date_result = mysqli_query($conn, $latest_date_query);
    $latest_date_row = mysqli_fetch_assoc($latest_date_result);
    $date_to_use = $latest_date_row['latest_date'];
}

$forms = ['form1', 'form2', 'form3', 'form4'];
$response = array();

foreach ($forms as $form) {
    // Query to count the number of 'Present' entries for the current form on the determined date
    $present_query = "SELECT COUNT(*) AS present_count FROM attendance WHERE status = 'Present' AND form = '$form' AND date = '$date_to_use'";
    $present_result = mysqli_query($conn, $present_query);
    $present_row = mysqli_fetch_assoc($present_result);
    $present_count = $present_row['present_count'];

    // Query to count the number of 'Absent' entries for the current form on the determined date
    $absent_query = "SELECT COUNT(*) AS absent_count FROM attendance WHERE status = 'Absent' AND form = '$form' AND date = '$date_to_use'";
    $absent_result = mysqli_query($conn, $absent_query);
    $absent_row = mysqli_fetch_assoc($absent_result);
    $absent_count = $absent_row['absent_count'];

    // Add the counts to the response array
    $response[$form] = array(
        'present_count' => $present_count,
        'absent_count' => $absent_count
    );
}

echo json_encode($response);

mysqli_close($conn);
?>
