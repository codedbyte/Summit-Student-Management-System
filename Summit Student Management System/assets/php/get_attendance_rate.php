<?php
include 'db_connect.php';

// Query to count the number of 'Present' entries
$present_query = "SELECT COUNT(*) AS present_count FROM attendance WHERE status = 'Present'";
$present_result = mysqli_query($conn, $present_query);
$present_row = mysqli_fetch_assoc($present_result);
$present_count = $present_row['present_count'];

// Query to count the number of 'Absent' entries
$absent_query = "SELECT COUNT(*) AS absent_count FROM attendance WHERE status = 'Absent'";
$absent_result = mysqli_query($conn, $absent_query);
$absent_row = mysqli_fetch_assoc($absent_result);
$absent_count = $absent_row['absent_count'];

// Calculate the attendance rate
if (($present_count + $absent_count) > 0) {
    $attendance_rate = ($present_count / ($present_count + $absent_count)) * 100;
} else {
    $attendance_rate = 0; // Handle cases where there are no records
}

// Return the attendance rate as a percentage
$response = array('rate' => round($attendance_rate, 2) . '%');
echo json_encode($response);

mysqli_close($conn);
?>
