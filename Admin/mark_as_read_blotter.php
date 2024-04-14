<?php 
	include '../config.php';

	// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_ids'])) {
	//   $complaintIds = $_POST['complaint_ids'];

	//   // Sanitize and validate the input if needed

	//   // Update the 'is_read' column in the database
	//   $updateQuery = "UPDATE complaint SET is_read = 1 WHERE complaint_ID IN (" . implode(',', $complaintIds) . ")";
	//   $result = mysqli_query($conn, $updateQuery);

	//   if ($result) {
	//     echo 'success';
	//   } else {
	//     echo 'error';
	//   }
	// } else {
	//   echo 'Invalid request.';
	// }


	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_ids'])) {
		foreach($_POST['complaint_ids'] as $complaintId){
			$sql = "SELECT * FROM blotter WHERE blotter_Id = '$complaintId'";
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			$incidentNature = $row['incidentNature'];
			$incidentDate = $row['incidentDate'];
			$incidentTime = $row['incidentTime'];
			$incidentAddress = $row['incidentAddress'];
			$contact = $row['c_contact'];
			$updateSql = "UPDATE blotter SET is_read='1' WHERE blotter_Id ='$complaintId'";
			$updateResult =  mysqli_query($conn,$updateSql);
				$ch = curl_init();
				$message = "Good day!\nYour blotter report has been read by the admin.\n\nDetails:\n";
				$message .= "Incident Nature: " . $incidentNature . "\n";
				$message .= "Incident Location: " . $incidentAddress . "\n";
				$message .= "Date Happened: " . $incidentDate . "\n";
				$message .= "Time Happened: " . $incidentTime . "\n";
				$message .= "Thank you for using our service.";

				$parameters = array(
					'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
					'number' => '0' . $contact,
					'message' => $message,
					'sendername' => 'SEMAPHORE'
				);
				curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/priority');
				curl_setopt($ch, CURLOPT_POST, 1);

				// Send the parameters set above with the request
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

				// Receive response from the server
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$output = curl_exec($ch);
				curl_close($ch);
				


		}
		echo 'success';
	  // Sanitize and validate the input if needed

	//   // Fetch user information and complaint details from the users and complaint tables
	//   $getUserInfoQuery = "SELECT u.firstname, u.lastname, u.contact, b.added_by, b.incidentNature, b.incidentAddress, b.incidentDate, b.incidentTime
	//                         FROM users u
	//                         JOIN blotter b ON u.user_Id = b.added_by
	//                         WHERE b.blotter_Id IN (" . implode(',', $complaintIds) . ")";
	//   $userInfoResult = mysqli_query($conn, $getUserInfoQuery);

	//   // Check if user information is fetched successfully
	//   if ($userInfoResult) {
	//     while ($userInfo = mysqli_fetch_assoc($userInfoResult)) {
	//       // Extract user information and complaint details
	//       $name = $userInfo['firstname'] . ' ' . $userInfo['lastname'];
	//       $contact = $userInfo['contact'];
	//       $complaintNature = $userInfo['incidentNature'];
	//       $incidentLocation = $userInfo['incidentAddress'];
	//       $dateHappened = $userInfo['incidentDate'];
	//       $timeHappened = $userInfo['incidentTime'];

	//       // Update the 'is_read' column in the database
	//       $updateQuery = "UPDATE blotter SET is_read = 1 WHERE blotter_Id IN (" . implode(',', $complaintIds) . ")";
	//       $result = mysqli_query($conn, $updateQuery);
	// 	  $ch = curl_init();
	// 		$message = "Good day " . ucwords($name) . "!\nYour blotter report has been read by the admin.\n\nDetails:\n";
	// 		$message .= "Incident Nature: " . $complaintNature . "\n";
	// 		$message .= "Incident Location: " . $incidentLocation . "\n";
	// 		$message .= "Date Happened: " . $dateHappened . "\n";
	// 		$message .= "Time Happened: " . $timeHappened . "\n";
	// 		$message .= "Thank you for using our service.";

	// 		$parameters = array(
	// 			'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
	// 			'number' => '0' . $contact,
	// 			'message' => $message,
	// 			'sendername' => 'SEMAPHORE'
	// 		);
	// 		curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/priority');
	// 		curl_setopt($ch, CURLOPT_POST, 1);

	// 		// Send the parameters set above with the request
	// 		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));

	// 		// Receive response from the server
	// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 		$output = curl_exec($ch);
	// 		curl_close($ch);

		
	//       // Send SMS to the user
	//       if ($result) {
	//       	echo 'success';
	        
	        
	//       } else {
	//         echo 'error_update: ' . mysqli_error($conn);
	//       }
	//     }
	//   } else {
	//     echo 'error_fetch: ' . mysqli_error($conn);
	//   }
	// } else {
	//   echo 'Invalid request.';
	// }

	// Function to send SMS
	// function sendSMS($name, $contact, $complaintNature, $incidentLocation, $dateHappened, $timeHappened) {
	  
}
?>
