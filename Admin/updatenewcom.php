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
    $status = $_POST['complaint_status'];
    
    foreach($selectedIds as $blotterId) {
        $query = "UPDATE complaint SET `status` = '$status' WHERE complaint_ID = '$blotterId'";
        $result = mysqli_query($conn, $query);

        $sql = "SELECT * FROM complaint WHERE complaint_ID = '$blotterId'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $ccomplaint_nature = $row['complaint_nature'];
        $incident_location = $row['incident_location'];
        $date_happened = $row['date_happened'];
        $time_happened = $row['time_happened'];
        $added_by = $row['added_by'];
        $bysql = "SELECT * FROM users WHERE user_Id = '$added_by'";
        $byresult = mysqli_query($conn, $bysql);

        $byrow = mysqli_fetch_assoc($byresult);
        $added_by = $byrow['firstname'].' '.$byrow['lastname'];
        $c_contact = $byrow['contact'];


        foreach($resultadmin as $data){
            $c_name = $data['firstname'].' '.$data['lastname'];
            $c_contact = $data['contact'];
            if($status == '0'){
                $status = 'Pending';
            }else if($status == '1'){
                $status = 'Verified';
            }else if($status == '2'){
                $status = 'Rejected';
            }else if($status == '3'){
                $status = 'Solved';
            }
            $ch = curl_init();
            $parameters = array(
                'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
                'number' => '0'.$c_contact,
                'message' => "Good day " . ucwords($c_name) . ", this is to inform you that the \nComplaint with the nature of " . $ccomplaint_nature . " at " . $incident_location . " on " . $date_happened . " " . $time_happened . " has been updated by " . $adminname . " to " . $status . ".\n\nThank you!",
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

            
           
            $ch = curl_init();
            $parameters = array(
                'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
                'number' => '0'.$contact,
                'message' => "Good day " . ucwords($name) . ", this is to inform you that the \nComplaint with the nature of " . $ccomplaint_nature . " at " . $incident_location . " on " . $date_happened . " " . $time_happened . " has been updated by " . $adminname . " to " . $status . ".\n\nThank you!",
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