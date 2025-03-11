<?php
include 'db_connect.php';

$query = "SELECT COUNT(id) AS count FROM students";
$result = mysqli_query($conn, $query);

$response = array();

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $response['count'] = $row['count'];
} else {
    $response['count'] = 0;
}

echo json_encode($response);

mysqli_close($conn);
?>
