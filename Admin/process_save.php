<?php 
	include '../config.php';
	// include('../phpqrcode/qrlib.php');
	include '../includes/function_create.php';
	

	// SAVE ADMIN - ADMIN_MGMT.PHP
	if (isset($_POST['create_admin'])) {
	    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
	    $path = "../images-users/";
	    saveUser($conn, "admin_mgmt.php?page=create", $user_type, $path);
	}


	// SAVE USERS - USERS_MGMT.PHP
	if (isset($_POST['create_user'])) {
		$user_type = "User";
		$path = "../images-users/";
	    saveUser($conn, "users_mgmt.php?page=create", $user_type, $path);
	}


	

	// DATABASE RESTORATION - RESTORE.PHP
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['restore'])) {
	    $file = $_FILES['fileToRestore']['tmp_name'];
	    if (!$file) {
	        die("Please choose a file to restore.");
	    }
	    $sql = file_get_contents($file);
	    $queries = explode(';', $sql);
	    foreach ($queries as $query) {
	        if (!empty(trim($query))) {
	            $result = mysqli_query($conn, $query);
	            if (!$result) {
	                die("Error executing SQL query: " . mysqli_error($conn));
	            }
	        }
	    }
	    $_SESSION['message'] = "Database restoration successful";
		$_SESSION['text'] = "Sent successfully!";
		$_SESSION['status'] = "success";
		header("Location: restore.php");
	}


	// CREATE BLOTTER  - BLOTTER.PHP
	if (isset($_POST['create_blotter'])) {
	    createBlotter($conn, $_POST, "blotter.php");
	}
	

	// CREATE COMPLAINT  - COMPLAINT.PHP
	if (isset($_POST['create_complaint'])) {
	    createComplaint($conn, $_POST, "complaint.php");
	}
	

	

	
?>



