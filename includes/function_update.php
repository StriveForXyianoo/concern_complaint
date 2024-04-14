<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// require '../vendor/PHPMailer/src/Exception.php';
	// require '../vendor/PHPMailer/src/PHPMailer.php';
	// require '../vendor/PHPMailer/src/SMTP.php';
	if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/PHPMailer/src/Exception.php'; }
	if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php'; }
	if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/PHPMailer/src/SMTP.php'; }

	
	function updateSystemUser($conn, $user_Id, $page, $user_type="User") {
		// $username       = ucwords(mysqli_real_escape_string($conn, $_POST['username']));
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = ucwords(mysqli_real_escape_string($conn, $_POST['age']));
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		// $email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$address        = ucwords(mysqli_real_escape_string($conn, $_POST['address']));

		$file             = basename($_FILES["fileToUpload"]["name"]);

		// $check_username = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND user_Id !='$user_Id'");
	    // if (mysqli_num_rows($check_username) > 0) {
	    //     displayErrorMessage("Username already exists!", $page);
	    // } else {
		//     $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id'");
		//     if (mysqli_num_rows($check_email) > 0) {
		//         displayErrorMessage("Email already exists!", $page);
		//     } else {
		    	$check_contact = mysqli_query($conn, "SELECT * FROM users WHERE contact='$contact' AND user_Id !='$user_Id'");
			    if (mysqli_num_rows($check_contact) > 0) {
			        displayErrorMessage("Contact number already exists!", $page);
			    } else {
					if(empty($file)) {
						$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', gender='$gender', contact='$contact', address='$address', user_type='$user_type' WHERE user_Id='$user_Id' ");
						displayUpdateMessage($update, $page);
					} else {
						// Check if image file is a actual image or fake image
						$target_dir = "../images-users/";
						$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
						$uploadOk = 1;
						$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

						$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    displayErrorMessage("File is not an image.", $page);
							$uploadOk = 0;
						} 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						    displayErrorMessage("File must be up to 500KB in size.", $page);
							$uploadOk = 0;
						}

						// Allow certain file formats
						elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
						    $uploadOk = 0;
						}

						// Check if $uploadOk is set to 0 by an error
						elseif ($uploadOk == 0) {
							displayErrorMessage("Your file was not uploaded.", $page);
						// if everything is ok, try to upload file
						} else {

							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
								$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', gender='$gender', contact='$contact', address='$address', user_type='$user_type', image='$file' WHERE user_Id='$user_Id' ");
			              	     displayUpdateMessage($update, $page);
							} else {
			    	            displayErrorMessage("There was an error uploading your profile picture.", $page);
							}
						}
					}
				}
		// 	}
		// }

	}





	// CHANGE ADMIN PASSWORD - ADMIN/ADMIN_DELETE.PHP
	function changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, $page) {

	    $check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	    if (mysqli_num_rows($check_old_password) === 1) {
	        if ($password != $cpassword) {
	            displayErrorMessage("Password did not match.", $page);
	        } else {
	            $update = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id'");
	            displayUpdateMessage($update, $page);
	        }
	    } else {
	    	displayErrorMessage("Old password is incorrect.", $page);
	    }
	}




	// UPDATE ADMIN PROFILE - ADMIN/PROFILE.PHP || || USER/PROFILE.PHP
	function updateProfileAdmin($conn, $user_Id, $page) {
	    $file = basename($_FILES["fileToUpload"]["name"]);
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . $file;
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if ($check === false) {
	        displayErrorMessage("Selected file is not an image.", $page);
	    }

	    if ($_FILES["fileToUpload"]["size"] > 500000) {
	        displayErrorMessage("File must be up to 500KB in size.", $page);
	    }

	    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
	        displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	    }

	    if ($_FILES["fileToUpload"]["error"] != 0) {
	        displayErrorMessage("Your file was not uploaded.", $page);
	    }

	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        $update = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	        displayUpdateMessage($update, $page);
	    } else {
	        displayErrorMessage("There was an error uploading your file.", $page);
	    }
	}




	// UPDATE ADMIN INFO - ADMIN/PROFILE.PHP || USER/PROFILE.PHP
	function updateProfileInfo($conn, $user_Id, $page) {
		// $username       = ucwords(mysqli_real_escape_string($conn, $_POST['username']));
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = ucwords(mysqli_real_escape_string($conn, $_POST['age']));
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		// $email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$address        = ucwords(mysqli_real_escape_string($conn, $_POST['address']));

		// $check_username = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND user_Id !='$user_Id'");
	    // if (mysqli_num_rows($check_username) > 0) {
	    //     displayErrorMessage("Username already exists!", $page);
	    // } else {
		//     $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id'");
		//     if (mysqli_num_rows($check_email) > 0) {
		//         displayErrorMessage("Email already exists!", $page);
		//     } else {
		    	$check_contact = mysqli_query($conn, "SELECT * FROM users WHERE contact='$contact' AND user_Id !='$user_Id'");
			    if (mysqli_num_rows($check_contact) > 0) {
			        displayErrorMessage("Contact number already exists!", $page);
			    } else {
			    	$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', gender='$gender', contact='$contact', address='$address' WHERE user_Id='$user_Id' ");
  	  				displayUpdateMessage($update, $page);
			    }
		// 	}
		// }
	}

?>



