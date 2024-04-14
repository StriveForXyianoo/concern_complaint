<?php 

	include 'config.php';
	include 'includes/function_create.php';

	// use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
    // require 'vendor/PHPMailer/src/Exception.php';
    // require 'vendor/PHPMailer/src/PHPMailer.php';
    // require 'vendor/PHPMailer/src/SMTP.php';


	if(isset($_POST['login'])) {
		$contact    = $_POST['contact'];
		$password = md5($_POST['password']);

		// Check if the user has attempted to log in before
		if (!isset($_SESSION['login_attempts'])) {
		    $_SESSION['login_attempts'] = 0;
		}

		// Check if the user has reached the maximum number of login attempts
		if ($_SESSION['login_attempts'] > 3) {
		    // Check if the user has been blocked for 30 minutes
		    if (time() - $_SESSION['last_login_attempt'] <= 600) {
		        // User is still blocked, display an error message and exit
				displayErrorMessage("You have been blocked for 10 minutes due to multiple failed login attempts.", "login.php");
		    } else {
		        // Block has expired, reset the login attempts counter
		        $_SESSION['login_attempts'] = 0;
		    }
		}


		$check = mysqli_query($conn, "SELECT * FROM users WHERE contact='$contact' AND password='$password'");
		if(mysqli_num_rows($check)===1) {
			$row = mysqli_fetch_array($check);
			$position = $row['user_type'];
			$log_ID = $row['user_Id'];

		    // Check if there is an ongoing session for this user
		    $previous_session_query = mysqli_query($conn, "SELECT * FROM log_history WHERE user_Id='$log_ID' AND logout_datetime='0000-00-00 00:00:00'");
		    $previous_session_row = mysqli_fetch_array($previous_session_query);

		    if ($previous_session_row) {
		        // If there is an ongoing session, update logout_remarks to 1
		        mysqli_query($conn, "UPDATE log_history SET logout_remarks=1 WHERE log_Id='" . $previous_session_row['log_Id'] . "'");
		    }
		    
			$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_datetime) VALUES ('$log_ID', NOW())");

			if ($login) {
		        $login_time_query = mysqli_query($conn, "SELECT NOW() AS login_time");
		        $login_time_row = mysqli_fetch_array($login_time_query);
		        $login_time = $login_time_row['login_time'];
		        $_SESSION['login_time'] = $login_time;
		    }

		    if($row['is_verified'] == 0) {
		    	$_SESSION['login_attempts']++;
			    $_SESSION['last_login_attempt'] = time();
				displayErrorMessage("Unverified accounts are not authorized to login", "login.php");
		    } else {
		    	if($position == 'Admin') {
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['admin_Id'] = $row['user_Id'];
					header("Location: Admin/dashboard.php");
					exit();
				} else {
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['user_Id'] = $row['user_Id'];
					header("Location: User/dashboard.php");
					exit();
				}
		    }
		    
			
		} else {
		    $_SESSION['login_attempts']++;
		    $_SESSION['last_login_attempt'] = time();
			displayErrorMessage("Incorrect password.", "login.php");
		}
	}


	if(isset($_GET['type']) && isset($_GET['user_Id'])) {
		$type = $_GET['type'];
		$user_Id = $_GET['user_Id'];

		$check = mysqli_query($conn, "SELECT * FROM users WHERE user_Id=$user_Id");
		if(mysqli_num_rows($check) > 0) {
			$update = mysqli_query($conn, "UPDATE users SET is_verified=1, verification_code=NULL WHERE user_Id=$user_Id");
			if($update) {

				$row = mysqli_fetch_array($check);
				$position = $row['user_type'];
				$log_ID = $row['user_Id'];

				
				// Check if there is an ongoing session for this user
			    $previous_session_query = mysqli_query($conn, "SELECT * FROM log_history WHERE user_Id='$log_ID' AND logout_datetime='0000-00-00 00:00:00'");
			    $previous_session_row = mysqli_fetch_array($previous_session_query);

			    if ($previous_session_row) {
			        // If there is an ongoing session, update logout_remarks to 1
			        mysqli_query($conn, "UPDATE log_history SET logout_remarks=1 WHERE log_Id='" . $previous_session_row['log_Id'] . "'");
			    }
			    
				$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_datetime) VALUES ('$log_ID', NOW())");

				if ($login) {
			        $login_time_query = mysqli_query($conn, "SELECT NOW() AS login_time");
			        $login_time_row = mysqli_fetch_array($login_time_query);
			        $login_time = $login_time_row['login_time'];
			        $_SESSION['login_time'] = $login_time;
			    }
			    
				if($position == 'Admin') {
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['admin_Id'] = $row['user_Id'];
					header("Location: Admin/dashboard.php");
					exit();
				} else {
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['user_Id'] = $row['user_Id'];
					header("Location: User/dashboard.php");
					exit();
				}
			} else {
				displayErrorMessage("Unknown error occured.", "login.php");
				exit();
			}
		} else {
			displayErrorMessage("User not found.", "login.php");
			exit();
		}

	}





	// REGISTER USER - REGISTER.PHP 
	if (isset($_POST['create_user'])) {
		// $username       = ucwords(mysqli_real_escape_string($conn, $_POST['username']));
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = intval($_POST['age']);
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		// $email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$address        = ucwords(mysqli_real_escape_string($conn, $_POST['address']));
		$password       = md5($_POST['password']);
		$file           = basename($_FILES["fileToUpload"]["name"]);

		$key      = substr(number_format(time() * rand(), 0, '', ''), 0, 4);
		$name = $firstname.' '.$lastname;

		$userGender = '';
	    if ($gender == 'Male') {
	        $userGender = 'Mr.';
	    } elseif ($gender == 'Female') {
	        $userGender = 'Ms./Mrs.';
	    }


		$check_contact = mysqli_query($conn, "SELECT * FROM users WHERE contact='$contact'");
	    if (mysqli_num_rows($check_contact) > 0) {
	        displayErrorMessage("Contact number already exists!", $page);
	    } else {
	    	if(empty($file)) {
	    		$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, dob, age, gender, contact, address, image, password, user_type, verification_code) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$gender', '$contact', '$address', 'user.png', '$password', 'User', '$key')");
	    		$user_Id = mysqli_insert_id($conn);

	    		$ch = curl_init();
				$parameters = array(
				    'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
				    'number' => '0'.$contact,
				    'message' => "Good day $userGender " . ucwords($name) . "!\nYour account verification code is $key.\nThank you for using our service.",
				    'sendername' => 'SEMAPHORE'
				);
				curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/priority' );
				curl_setopt( $ch, CURLOPT_POST, 1 );

				//Send the parameters set above with the request
				curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

				// Receive response from server
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				$output = curl_exec( $ch );
				curl_close ($ch);

				//Show the server response
				echo $output; 

            	$_SESSION['message'] = "A verification code has been sent to your mobile number";
				$_SESSION['text'] = "Sent successfully!";
				$_SESSION['status'] = "success";
				header("Location: verifycode.php?type=account-verification&&user_Id=".$user_Id."&&contact=".$contact);
            	
	    	} else {
		        $target_dir = "images-users/";
		        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		        $uploadOk = 1;
		        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		        if ($check == false) {
		            displayErrorMessage("File is not an image.", $page);
		            $uploadOk = 0;
		        } elseif ($_FILES["fileToUpload"]["size"] > 500000) {
		            displayErrorMessage("File must be up to 500KB in size.", $page);
		            $uploadOk = 0;
		        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		            displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
		            $uploadOk = 0;
		        } elseif ($uploadOk == 0) {
		            displayErrorMessage("Your file was not uploaded.", $page);
		        } else {
		            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		            	$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, dob, age, gender, contact, address, image, password, user_type, verification_code) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$gender', '$contact', '$address', '$file', '$password', 'User', '$key')");
		            	$user_Id = mysqli_insert_id($conn);

		            	$ch = curl_init();
						$parameters = array(
						    'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
						    'number' => '0'.$contact,
						    'message' => "Good day $userGender " . ucwords($name) . "!\nYour account verification code is $key.\nThank you for using our service.",
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


		            	$_SESSION['message'] = "A verification code has been sent to your mobile number";
						$_SESSION['text'] = "Sent successfully!";
						$_SESSION['status'] = "success";
						header("Location: verifycode.php?type=account-verification&&user_Id=".$user_Id."&&contact=".$contact);
		            } else {
		            	displayErrorMessage("There was an error uploading your profile picture.", $page); 
		            }
		        }
		    }
		}
		
	}





	// SEARCH EMAIL - FORGOT-PASSWORD.PHP
	if(isset($_POST['search'])) {
      $contact = mysqli_real_escape_string($conn, $_POST['contact']);
      $fetch = mysqli_query($conn, "SELECT * FROM users WHERE contact='$contact'");
      if(mysqli_num_rows($fetch) > 0) {
      	$row = mysqli_fetch_array($fetch);
      	$user_Id = $row['user_Id'];
      	header("Location: sendcode.php?user_Id=".$user_Id);
      	exit();
      } else {
		displayErrorMessage("Contact number not found.", "forgot-password.php");
      }
	}





	// SEND CODE - SENDCODE.PHP
	if(isset($_POST['sendcode'])) {
	    $contact    = $_POST['contact'];
	    $user_Id  = $_POST['user_Id'];
	    $key      = substr(number_format(time() * rand(), 0, '', ''), 0, 4);

	    $fetch_gender = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_assoc($fetch_gender);
		$name = $row['firstname'].' '.$row['lastname'];
		$gender = '';

		if ($row && isset($row['gender'])) {
		    $userGender = $row['gender'];

		    if ($userGender == 'Male') {
		        $gender = 'Mr.';
		    } elseif ($userGender == 'Female') {
		        $gender = 'Ms./Mrs.';
		    }
		}

	    $insert_code = mysqli_query($conn, "UPDATE users SET verification_code='$key' WHERE contact='$contact' AND user_Id='$user_Id'");
	    if($insert_code) {

	        $ch = curl_init();
			$parameters = array(
			    'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
			    'number' => '0'.$contact,
			    'message' => "Good day $gender " . ucwords($name) . "!\nYour account verification code is $key.\nThank you for using our service.",
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

			$_SESSION['message'] = "A verification code has been sent to your mobile number";
			$_SESSION['text'] = "Sent successfully!";
			$_SESSION['status'] = "success";
			header("Location: verifycode.php?type=account-recovery&&user_Id=".$user_Id."&&contact=".$contact);

	    } else {
	        displayErrorMessage("Something went wrong while generating the verification code through email.", "sendcode.php?user_Id=".$user_Id);
	    } 
	}



	// VERIFY CODE - VERIFYCODE.PHP
	if(isset($_POST['verify_code'])) {
	    $user_Id = $_POST['user_Id'];
	    $contact   = $_POST['contact'];
	    $code    = mysqli_real_escape_string($conn, $_POST['code']);
	    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE contact='$contact' AND verification_code='$code' AND user_Id='$user_Id'");
	    if(mysqli_num_rows($fetch) > 0) {
			header("Location: changepassword.php?user_Id=".$user_Id);
			exit();
		} else {
			displayErrorMessage("Verification code is incorrect.", "verifycode.php?type=account-recovery&&user_Id=".$user_Id."&&contact=".$contact);
		}
	}



	// VERIFY ACCOUNT - VERIFYCODE.PHP
	if(isset($_POST['verify_account'])) {
	    $user_Id = $_POST['user_Id'];
	    $contact   = $_POST['contact'];
	    $code    = mysqli_real_escape_string($conn, $_POST['code']);
	    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE contact='$contact' AND verification_code='$code' AND user_Id='$user_Id'");
	    if(mysqli_num_rows($fetch) > 0) {
	    	$row = mysqli_fetch_array($fetch);
			$position = $row['user_type'];
			$log_ID = $row['user_Id'];
			$update = mysqli_query($conn, "UPDATE users SET is_verified=1, verification_code=NULL WHERE user_Id=$user_Id");
			if($update) {

				// Check if there is an ongoing session for this user
			    $previous_session_query = mysqli_query($conn, "SELECT * FROM log_history WHERE user_Id='$log_ID' AND logout_datetime='0000-00-00 00:00:00'");
			    $previous_session_row = mysqli_fetch_array($previous_session_query);

			    if ($previous_session_row) {
			        // If there is an ongoing session, update logout_remarks to 1
			        mysqli_query($conn, "UPDATE log_history SET logout_remarks=1 WHERE log_Id='" . $previous_session_row['log_Id'] . "'");
			    }
			    
				$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_datetime) VALUES ('$log_ID', NOW())");

				if ($login) {
			        $login_time_query = mysqli_query($conn, "SELECT NOW() AS login_time");
			        $login_time_row = mysqli_fetch_array($login_time_query);
			        $login_time = $login_time_row['login_time'];
			        $_SESSION['login_time'] = $login_time;
			    }
			    
				if($position == 'Admin') {
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['admin_Id'] = $row['user_Id'];
					header("Location: Admin/dashboard.php");
					exit();
				} else {
					$_SESSION['login_attempts'] = 0;
		    		$_SESSION['last_login_attempt'] = time();
					$_SESSION['user_Id'] = $row['user_Id'];
					header("Location: User/dashboard.php");
					exit();
				}
			} else {
				displayErrorMessage("Unknown error occured.", "login.php");
				exit();
			}
		} else {
			displayErrorMessage("Verification code is incorrect.", "verifycode.php?type=account-verification&&user_Id=".$user_Id."&&contact=".$contact);
		}
	}



	// CHANGE PASSWORD - CHANGEPASSWORD.PHP
	if(isset($_POST['changepassword'])) {
		$user_Id   = $_POST['user_Id'];
		$cpassword = md5($_POST['cpassword']);

		$update = mysqli_query($conn, "UPDATE users SET password='$cpassword', verification_code=NULL WHERE user_Id='$user_Id' ");
		displayUpdateMessage($update, "login.php");
	}


?>
