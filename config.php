<?php 

	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	date_default_timezone_set('Asia/Manila');
	// get current date and time
    $date_today = date('Y-m-d');
    // get yesterday's date
	$yesterday_date = date('Y-m-d', strtotime('-1 day'));

	$conn = mysqli_connect("localhost", "root", "", "concern_complaint");
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}


	// FUNCTION TO HANDLE SUCCESS MESSAGES 
	function displaySaveMessage($saveStatus, $page) {
		if ($saveStatus) {
			$_SESSION['message'] = "New record has been added.";
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			header("Location: $page");
			exit();
		} else {
			$_SESSION['message'] = "Error.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: $page");
			exit();
		}
	}

	// FUNCTION TO HANDLE SUCCESS MESSAGES 
	function displayUpdateMessage($updateStatus, $page) {
		if ($updateStatus) {
			$_SESSION['message'] = "Record has been updated.";
			$_SESSION['text'] = "Updated successfully!";
			$_SESSION['status'] = "success";
			header("Location: $page");
			exit();
		} else {
			$_SESSION['message'] = "Error.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: $page");
			exit();
		}
	}


	// FUNCTION TO HANDLE ERROR MESSAGES
	function displayErrorMessage($errorMessage, $page) {
		$_SESSION['message'] = $errorMessage;
	    $_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
	    header("Location: $page");
		exit();
	}


	function calculateFormattedAge($dob) {
	    $dobDate = new DateTime($dob);
	    $currentDate = new DateTime();
	    $ageInterval = $currentDate->diff($dobDate);

	    if ($ageInterval->y > 0) {
	        return $ageInterval->y . ' years old';
	    } elseif ($ageInterval->m > 0) {
	        return $ageInterval->m . ' months old';
	    } else {
	        return floor($ageInterval->d / 7) . ' weeks old';
	    }
	}
?>