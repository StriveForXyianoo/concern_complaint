<?php 
	include '../config.php';
	include '../includes/function_update.php';

		
	// UPDATE ADMIN - ADMIN_MGMT.PHP
	if(isset($_POST['update_admin'])) {
		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = mysqli_real_escape_string($conn, $_POST['user_type']);
		updateSystemUser($conn, $user_Id, "admin_mgmt.php?page=".$user_Id, $user_type);
	}




	// CHANGE ADMIN PASSWORD - ADMIN_DELETE.PHP
	if (isset($_POST['password_admin'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);

	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "admin.php");
	}




	// UPDATE USER - USERS_MGMT.PHP
	if(isset($_POST['update_user'])) {
		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = "User";
		updateSystemUser($conn, $user_Id,  "users_mgmt.php?page=".$user_Id, $user_type);
	}
    



	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['password_user'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);

	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "users.php");
	}




	// UPDATE ADMIN INFO - PROFILE.PHP
	if (isset($_POST['update_profile_info'])) {
	    $user_Id = mysqli_real_escape_string($conn, $_POST['user_Id']);
	    updateProfileInfo($conn, $user_Id, "profile.php");
	}




	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['update_password_admin'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);

	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "profile.php");
	}

		


	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if (isset($_POST['update_profile_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    updateProfileAdmin($conn, $user_Id, "profile.php");
	}





	




	// UPDATE BLOTTER - BLOTTER_UPDATE.PHP
	if(isset($_POST['update_blotter'])) {
		$blotter_Id          = mysqli_real_escape_string($conn, $_POST['blotter_Id']);
		$c_firstname         = mysqli_real_escape_string($conn, $_POST['c_firstname']);
		$c_middlename        = mysqli_real_escape_string($conn, $_POST['c_middlename']);
		$c_lastname          = mysqli_real_escape_string($conn, $_POST['c_lastname']);
		$c_suffix            = mysqli_real_escape_string($conn, $_POST['c_suffix']);
		$c_contact           = mysqli_real_escape_string($conn, $_POST['c_contact']);
		$c_address           = mysqli_real_escape_string($conn, $_POST['c_address']);
		$incidentDate        = mysqli_real_escape_string($conn, $_POST['incidentDate']);
		$incidentTime        = mysqli_real_escape_string($conn, $_POST['incidentTime']);
		$incidentNature      = mysqli_real_escape_string($conn, $_POST['incidentNature']);
		$incidentAddress     = mysqli_real_escape_string($conn, $_POST['incidentAddress']);
		$acc_firstname       = mysqli_real_escape_string($conn, $_POST['acc_firstname']);
		$acc_middlename      = mysqli_real_escape_string($conn, $_POST['acc_middlename']);
		$acc_lastname        = mysqli_real_escape_string($conn, $_POST['acc_lastname']);
		$acc_suffix          = mysqli_real_escape_string($conn, $_POST['acc_suffix']);
		$acc_address         = mysqli_real_escape_string($conn, $_POST['acc_address']);
		$witnesses           = mysqli_real_escape_string($conn, $_POST['witnesses']);
		$incidentDescription = mysqli_real_escape_string($conn, $_POST['incidentDescription']);
		$actionTaken         = mysqli_real_escape_string($conn, $_POST['actionTaken']);
		
		$file_name = $_FILES["fileToUpload"]["name"];
		$location  = "../images-blotter/";
		$image_name = implode(",",$file_name);

		$fetch = mysqli_query($conn, "SELECT * FROM blotter WHERE blotter_Id=$blotter_Id");
		$row = mysqli_fetch_array($fetch);
		$old_attachments = $row['attachments'];
		

		if (!empty(array_filter($file_name))) {
			foreach ($file_name as $key => $val) {
				$targetPath = $location .$val;
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key],$targetPath);
			}
			$attachmentsToUpdate = $image_name;
			$updated = mysqli_query($conn, "UPDATE blotter SET c_firstname='$c_firstname', c_middlename='$c_middlename', c_lastname='$c_lastname', c_suffix='$c_suffix', c_contact='$c_contact', c_address='$c_address', incidentDate='$incidentDate', incidentTime='$incidentTime', incidentNature='$incidentNature', incidentAddress='$incidentAddress', acc_firstname='$acc_firstname', acc_middlename='$acc_middlename', acc_lastname='$acc_lastname', acc_suffix='$acc_suffix', acc_address='$acc_address', witnesses='$witnesses', incidentDescription='$incidentDescription', actionTaken='$actionTaken', attachments='$attachmentsToUpdate' WHERE blotter_Id='$blotter_Id'");
		} else {
			$attachmentsToUpdate = $old_attachments;
			$updated = mysqli_query($conn, "UPDATE blotter SET c_firstname='$c_firstname', c_middlename='$c_middlename', c_lastname='$c_lastname', c_suffix='$c_suffix', c_contact='$c_contact', c_address='$c_address', incidentDate='$incidentDate', incidentTime='$incidentTime', incidentNature='$incidentNature', incidentAddress='$incidentAddress', acc_firstname='$acc_firstname', acc_middlename='$acc_middlename', acc_lastname='$acc_lastname', acc_suffix='$acc_suffix', acc_address='$acc_address', witnesses='$witnesses', incidentDescription='$incidentDescription', actionTaken='$actionTaken', attachments='$attachmentsToUpdate' WHERE blotter_Id='$blotter_Id'");

		}
		if($updated) {
		  	$_SESSION['message'] = "Blotter has been updated.";
		    $_SESSION['text'] = "Updated successfully!";
		    $_SESSION['status'] = "success";
			header("Location: blotter_update.php?blotter_Id=".$blotter_Id);
		  } else {
		    $_SESSION['message'] = "Something went wrong while updating the information.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: blotter_update.php?blotter_Id=".$blotter_Id);
		  }

		
	}



	
// UPDATE BLOTTER - BLOTTER_UPDATE.PHP
if(isset($_POST['update_blotter_status'])) {
	$blotter_Id          = mysqli_real_escape_string($conn, $_POST['blotter_Id']);
	$blotter_status         = mysqli_real_escape_string($conn, $_POST['blotter_status']);

	$status = '';
		if($blotter_status == 0) {
			$status = 'Open';
		} elseif($blotter_status == 1) {
			$status = 'Closed';
		} elseif($blotter_status == 2) {
			$status = 'Under Investigation';
		}  else {
			$status = 'Unknown status';
		}

		$get = mysqli_query($conn, "SELECT * FROM blotter WHERE blotter_Id='$blotter_Id'");
		$row = mysqli_fetch_array($get);
		$name = $row['c_firstname'].' '.$row['c_lastname'];
		$contact = $row['c_contact'];

	
	$updated = mysqli_query($conn, "UPDATE blotter SET blotter_status='$blotter_status' WHERE blotter_Id='$blotter_Id'");
	
	  if($updated) {
	  	$ch = curl_init();
			$parameters = array(
			    'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
			    'number' => '0'.$contact,
			    'message' => "Good day! " . ucwords($name) . "!\nYour reported blotter about ".ucwords($row['incidentNature'])." on ".$row['incidentDate']." ".$row['incidentTime']." was updated its status into ".$status.". ",
			    'sendername' => 'SEMAPHORE'
			);
			curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
			curl_setopt( $ch, CURLOPT_POST, 1 );

			//Send the parameters set above with the request
			curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

			// Receive response from server
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			$output = curl_exec( $ch );
			curl_close ($ch);

			//Show the server response
			echo $output;
			
	  	$_SESSION['message'] = "Blotter status has been updated.";
	    $_SESSION['text'] = "Updated successfully!";
	    $_SESSION['status'] = "success";
		header("Location: blotter.php");
	  } else {
	    $_SESSION['message'] = "Something went wrong while updating the information.";
	    $_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
		header("Location: blotter.php");
	  }

	
}
	





	// UPDATE COMPLAINT - COMPLAINT_MGMT.PHP
	if(isset($_POST['update_complaint'])) {
		$complaint_ID       = mysqli_real_escape_string($conn, $_POST['complaint_ID']);
	    $complaint_nature   = mysqli_real_escape_string($conn, $_POST['complaint_nature']);
		$incident_location  = mysqli_real_escape_string($conn, $_POST['incident_location']);
		$date_happened      = mysqli_real_escape_string($conn, $_POST['date_happened']);
		$time_happened      = mysqli_real_escape_string($conn, $_POST['time_happened']);
		$witness            = mysqli_real_escape_string($conn, $_POST['witness']);
		$details            = mysqli_real_escape_string($conn, $_POST['details']);
		$preferred_solution = mysqli_real_escape_string($conn, $_POST['preferred_solution']);
		
		$file_name = $_FILES["fileToUpload"]["name"];
		$location  = "../images-complaints/";
		$image_name = implode(",",$file_name);

		$fetch = mysqli_query($conn, "SELECT * FROM complaint WHERE complaint_ID=$complaint_ID");
		$row = mysqli_fetch_array($fetch);
		$old_attachments = $row['attachments'];

		if (!empty(array_filter($file_name))) {
		    // Upload new attachments
		    foreach ($file_name as $key => $val) {
		        $targetPath = $location . $val;
		        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $targetPath);
		    }

			$attachmentsToUpdate = $image_name;
			 $updated = mysqli_query($conn, "UPDATE complaint SET complaint_nature='$complaint_nature', incident_location='$incident_location', date_happened='$date_happened', time_happened='$time_happened', witness='$witness', details='$details', preferred_solution='$preferred_solution', attachments='$attachmentsToUpdate' WHERE complaint_ID='$complaint_ID'");
		} else {
			$attachmentsToUpdate = $old_attachments;
			$updated = mysqli_query($conn, "UPDATE complaint SET complaint_nature='$complaint_nature', incident_location='$incident_location', date_happened='$date_happened', time_happened='$time_happened', witness='$witness', details='$details', preferred_solution='$preferred_solution', attachments='$attachmentsToUpdate' WHERE complaint_ID='$complaint_ID'");
		}
		if ($updated) {
		    $_SESSION['message'] = "Complaint has been updated.";
		    $_SESSION['text'] = "Updated successfully!";
		    $_SESSION['status'] = "success";
		    header("Location: complaint_mgmt.php?page=".$complaint_ID);
		} else {
		    $_SESSION['message'] = "Something went wrong while updating the information.";
		    $_SESSION['text'] = "Error: " . mysqli_error($conn); // Print the error message
		    $_SESSION['status'] = "error";
		    header("Location: complaint_mgmt.php?page=".$complaint_ID);
		}
	}



	// UPDATE COMPLAINT - COMPLAINT_MGMT.PHP
	if(isset($_POST['update_complaint_status'])) {
		$complaint_ID          = mysqli_real_escape_string($conn, $_POST['complaint_ID']);
		$complaint_status         = mysqli_real_escape_string($conn, $_POST['complaint_status']);

		$status = '';
		if($complaint_status == 0) {
			$status = 'Pending';
		} elseif($complaint_status == 1) {
			$status = 'Verified';
		} elseif($complaint_status == 2) {
			$status = 'Rejected';
		} elseif($complaint_status == 3) {
			$status = 'Solved';
		} else {
			$status = 'Unknown status';
		}

		$get = mysqli_query($conn, "SELECT * FROM complaint JOIN users ON complaint.added_by=users.user_Id WHERE complaint.complaint_ID='$complaint_ID'");
		$row = mysqli_fetch_array($get);
		$name = $row['firstname'].' '.$row['lastname'];
		$email = $row['email'];
		$contact = $row['contact'];
		$gender = '';

		if ($row && isset($row['gender'])) {
		    $userGender = $row['gender'];

		    if ($userGender == 'Male') {
		        $gender = 'Mr.';
		    } elseif ($userGender == 'Female') {
		        $gender = 'Ms./Mrs.';
		    }
		}
		
		$updated = mysqli_query($conn, "UPDATE complaint SET status='$complaint_status' WHERE complaint_ID='$complaint_ID'");
		
		  if($updated) {
		  	$ch = curl_init();
			$parameters = array(
			    'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
			    'number' => '0'.$contact,
			    'message' => "Good day $gender " . ucwords($name) . "!\nYour complaint about ".ucwords($row['complaint_nature'])." was updated its status into ".$status.". ",
			    'sendername' => 'SEMAPHORE'
			);
			curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
			curl_setopt( $ch, CURLOPT_POST, 1 );

			//Send the parameters set above with the request
			curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

			// Receive response from server
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			$output = curl_exec( $ch );
			curl_close ($ch);

			//Show the server response
			echo $output;

		  	$_SESSION['message'] = "Complaint status has been updated.";
		    $_SESSION['text'] = "Updated successfully!";
		    $_SESSION['status'] = "success";
			header("Location: complaint.php");
		  } else {
		    $_SESSION['message'] = "Something went wrong while updating the information.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: complaint.php");
		  }

		
	}
		




?>
