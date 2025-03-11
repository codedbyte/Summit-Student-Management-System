<?php
include 'db_connect.php';

$query = "SELECT COUNT(id) AS count FROM notifications";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo $row['count'];
} else {
    echo "0";
}

mysqli_close($conn);
?>
