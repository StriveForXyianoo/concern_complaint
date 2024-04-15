<?php
include '../config.php';


    $selectedIds = explode(',', $_POST['selectedIds']); // Convert the comma-separated string of IDs into an array
    
    foreach($selectedIds as $blotterId) {
        $query = "DELETE FROM blotter WHERE blotter_Id = '$blotterId'";
        $result = mysqli_query($conn, $query);

    }
    if($query) {
            $_SESSION['message'] = "Record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
            header('Location: blotter.php');
        
    } else {
        $_SESSION['message'] = "Deletion failed!";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header('Location: blotter.php');
        
    }

?>