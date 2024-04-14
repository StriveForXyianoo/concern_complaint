<?php 
	include '../config.php';
	include '../includes/function_delete.php';

	// DELETE ADMIN - ADMIN_DELETE.PHP
	if (isset($_POST['delete_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "admin.php");
	}


	// DELETE USER - USERS_DELETE.PHP
	if (isset($_POST['delete_user'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "users.php");
	}


	

	// DELETE BLOTTER - BLOTTER_DELETE.PHP
	if (isset($_POST['delete_blotter'])) {
	    $blotter_Id = $_POST['blotter_Id'];
	    deleteRecord($conn, "blotter", "blotter_Id", $blotter_Id, "blotter.php");
	}


	// DELETE BLOTTER - BLOTTER_DELETE.PHP
	if (isset($_POST['delete_complaint'])) {
	    $complaint_ID = $_POST['complaint_ID'];
	    deleteRecord($conn, "complaint", "complaint_ID", $complaint_ID, "complaint.php");
	}





?>




