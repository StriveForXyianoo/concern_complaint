<?php
include '../config.php';
    $adminid =  $_SESSION['admin_Id'];
    $sql = "SELECT * FROM users WHERE user_ID = '$adminid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $adminname = $row['firstname'].' '.$row['lastname'];
    $sqladmin = "SELECT * FROM users WHERE user_type ='Admin'";
    $resultadmin = mysqli_query($conn, $sqladmin);

    $selectedIds = explode(',', $_POST['selectedIdss']); // Convert the comma-separated string of IDs into an array
    $status = $_POST['blotter_status'];
    foreach($selectedIds as $blotterId) {
        $query = "UPDATE blotter SET blotter_status = '$status' WHERE blotter_Id = '$blotterId'";
        $result = mysqli_query($conn, $query);

        $sql = "SELECT * FROM blotter WHERE blotter_Id = '$blotterId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $ccomplaint_nature = $row['incidentNature'];
        $incident_location = $row['incidentLocation'];
        $date_happened = $row['incidentDate'];
        $time_happened = $row['incidentTime'];
        $c_contact = $row['c_contact'];
        if($status == '0'){
            $status = 'Close';
        }else if($status == '1'){
            $status = 'Open';
        }else if($status == '2'){
            $status = 'Under Investigation';
        }
            $ch = curl_init();
            $parameters = array(
                'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
                'number' => '0'.$c_contact,
                'message' => "Good day " . ucwords($name) . ", this is to inform you that the \nBlotter with the nature of " . $ccomplaint_nature . " at " . $incident_location . " on " . $date_happened . " " . $time_happened . " has been updated by " . $adminname . " to " . $status . ".\n\nThank you!",
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


        foreach($resultadmin as $data){
            $name = $data['firstname'].' '.$data['lastname'];
            $contact = $data['contact'];
            $ch = curl_init();
            
            $ch = curl_init();
            $parameters = array(
                'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
                'number' => '0'.$contact,
                'message' => "Good day " . ucwords($name) . ", this is to inform you that the \nBlotter with the nature of " . $ccomplaint_nature . " at " . $incident_location . " on " . $date_happened . " " . $time_happened . " has been updated by " . $adminname . " to " . $status . ".\n\nThank you!",
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

        }

    }
    if($result) {
            $_SESSION['message'] = "Record has been updated!";
            $_SESSION['text'] = "Updated successfully!";
            $_SESSION['status'] = "success";
        
    } else {
        $_SESSION['message'] = "Update failed!";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        
    }

?>