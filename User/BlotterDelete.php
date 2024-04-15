<?php
include '../config.php';
$selectedIds = explode(',', $_POST['complaint_ID']);
foreach($selectedIds as $userID) {
    $query = "DELETE FROM blotter WHERE blotter_Id = '$userID'";
    $result = mysqli_query($conn, $query);
}
$_SESSION['message'] = "Record has been Deleted!";
$_SESSION['text'] = "Deleted successfully!";
$_SESSION['status'] = "success";
header('Location: blotter.php');
?>