<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $value = $_POST['value'];

    // Check if the value already exists in the database
    $query = "SELECT COUNT(*) as count FROM users WHERE $type = '$value'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] > 0) {
        echo 'exists';
    } else {
        echo 'not_exists';
    }
}

mysqli_close($conn);
?>
