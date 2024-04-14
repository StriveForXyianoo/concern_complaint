<?php
include '../config.php';
    $selectedIds = explode(',', $_POST['user_IdHAHA']); // Convert the comma-separated string of IDs into an array
    foreach($selectedIds as $userID) {
        $query = "DELETE FROM users WHERE user_Id = '$userID'";
        $result = mysqli_query($conn, $query);
    }
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['text'] = "Updated successfully!";
    $_SESSION['status'] = "success";
    header('Location: users.php');
?>