<?php 
	include '../config.php';
	include '../includes/function_delete.php';

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




