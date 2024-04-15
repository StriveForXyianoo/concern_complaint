<?php
include '../config.php';
    $adminid =  $_SESSION['admin_Id'];
    $sql = "SELECT * FROM users WHERE user_ID = '$adminid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $adminname = $row['firstname'].' '.$row['lastname'];

    $selectedIds = explode(',', $_POST['selectedIdss']); // Convert the comma-separated string of IDs into an array
    
    foreach($selectedIds as $blotterId) {
        $status = $_POST['blotter_status'];
        $query = "UPDATE blotter SET blotter_status = '$status' WHERE blotter_Id = '$blotterId'";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        } else {
            $query2 = "SELECT * FROM blotter WHERE blotter_Id = '$blotterId'";
            $result2 = mysqli_query($conn, $query2);
            $row = mysqli_fetch_assoc($result2);
            $ccomplaint_nature = $row['incidentNature'];
            $incident_location = $row['incidentAddress'];
            $date_happened = $row['incidentDate'];
            $time_happened = $row['incidentTime'];
            $c_contact = $row['c_contact'];
            $date_happened = date('M d, Y', strtotime($date_happened));


            if($status == '0'){
                $status = 'Open';
            }else if($status == '1'){
                $status = 'Close';
            }else if($status == '2'){
                $status = 'Under Investigation';
            }
            //select * admin
            $query3 = "SELECT * FROM users WHERE user_type='Admin'";
            $result3 = mysqli_query($conn, $query3);
            $row3 = mysqli_fetch_assoc($result3);
            $admin_contact = $row3['contact'];
            $adminName = $row3['firstname'] . " " . $row3['lastname'];
            $message = "Good Day!"."\n";
            $message .= "This is Admin " . $adminName . "\n";
            $message .= "The Blotter with the nature of " . $ccomplaint_nature . " at " . $incident_location . " on " . $date_happened . " " . $time_happened . " has been updated to " . $status . "\n";

                $ch = curl_init();
                $parameters = array(
                'apikey' => 'e73351f595cf7eaee32df330e33853f7', //Your API KEY
                'number' => '0'.$c_contact,
                'message' => $message,
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

                

           
        }

        

           

        
    }
    
    ?>
    <script>
        alert("Blotter Updated Successfully");
        window.location = "blotter.php";
    </script>
  
    <?php
        
    

?>