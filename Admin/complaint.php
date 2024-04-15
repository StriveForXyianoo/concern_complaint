<title>Concern and Complaint Reporting System | Complaint records</title>
<?php 
    require_once 'sidebar.php'; 
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Complaint</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Complaint Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-comment-alt nav-icon"></i> Delete complaint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
      <form id="DeleteForm" method="POST">
                    <input type="hidden" name="selectedIds" id="selectedIds" value="">
          <h6 class="text-center">Delete complaint record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_complaint"><i class="fas fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <a href="complaint_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Complaint</a>
                    <div class="card-tools mr-1">
                          <a class="btn btn-primary btn-sm disabled view-btn" ><i class="fas fa-folder"></i> View</a>
                          <button type="button" class="btn bg-warning btn-sm disabled status-btn" data-toggle="modal" data-target="#updateStatus"><i class="fas fa-pencil-alt"></i> Status</button>
                          <button type="button" class="btn bg-danger btn-sm disabled delete-btn" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i> Delete </button>
                    </div>
              </div>
              <div class="card-body p-3">
                 <!-- <table id="example1" class="table table-bordered table-hover text-sm"> -->
                 <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th></th>
                    <th>COMPLAINANTS</th>
                    <th>NATURE OF COMPLAINT</th>
                    <th>INCIDENT LOCATION</th>
                    <th>DATETIME OF INCIDENT</th>
                    <th>STATUS</th>
                    <!-- <th>TOOLS</th> -->
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM complaint JOIN users ON complaint.added_by=users.user_Id ORDER BY complaint.date_happened  DESC");
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td class="text-center">
                        <div class="icheck-primary">
                            <input type="checkbox" value="<?= $row['complaint_ID']; ?>" class="check-item" id="check<?= $row['complaint_ID']; ?>">
                            <label for="check<?= $row2['complaint_ID '];?>"></label>
                        </div></td>
                        <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                        <td><?php echo ucwords($row['complaint_nature']); ?></td>
                        <td><?php echo ucwords($row['incident_location']); ?></td>
                        <td><?php echo date("F d, Y",strtotime($row['date_happened'])).' <br>'.$row['time_happened']; ?></td>
                        <td>
                          <?php 
                            if($row['status'] == 0) {
                             echo '<span class="badge badge-info">Pending</span>';
                            } elseif($row['status'] == 1) {
                             echo '<span class="badge badge-success">On Process</span>';
                            } elseif($row['status'] == 2) {
                             echo '<span class="badge badge-danger">Rejected</span>';
                            } else {
                             echo '<span class="badge badge-primary">Solved</span>';
                            }
                          ?>
                        </td>
                       
                    </tr>
                  <?php  } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
<script>
    $(document).ready(function(){
        // Function to handle checkbox change event
        $(document).on('change', '.check-item', function(){
            var checkedCount = $('.check-item:checked').length;
            $('.view-btn').toggleClass('disabled', checkedCount !== 1);
            $('.delete-btn, .status-btn').toggleClass('disabled', checkedCount === 0);
            
            // If exactly one checkbox is checked, update the href attribute of the "View" button
            if (checkedCount === 1) {
                var checkedCheckbox = $('.check-item:checked');
                var blotterId = checkedCheckbox.val();
                $('.view-btn').attr('href', 'complaint_view.php?complaint_ID=' + blotterId);
            } else {
                $('.view-btn').removeAttr('href'); // Remove the href attribute if no checkbox or multiple checkboxes are checked
            }
        });

        // Function to handle "View" button click event
        $(document).on('click', '.view-btn', function(event){
            if ($(this).hasClass('disabled')) {
                event.preventDefault(); // Prevent the default action if the button is disabled
            } else {
                // Redirect to the URL specified in the href attribute
                window.location.href = $(this).attr('href');
            }
        });

        // Function to handle "Status" button click event
    $('.status-btn').click(function() {
        var selectedIds = $('.check-item:checked').map(function() {
            return $(this).val();
        }).get();
        $('#selectedIdss').val(selectedIds.join(','));
        // Set the value of hidden input field with selected IDs
        $('#updateStatus').modal('show'); // Show the modal
    });

    // Function to handle form submission for updating status
    $('#updateStatusForm').submit(function(event) {
        // event.preventDefault(); // Prevent default form submission
        
        var formData = $(this).serialize(); // Serialize form data
        // Send AJAX request to update status
        $.ajax({
            type: 'POST',
            url: 'updatenewcom.php',
            data: formData,
            success: function(response) {
             
                // Handle success
                console.log(response);
                // window.location.reload();
            
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('Error updating status!');
                console.error(error);
            }
        });
    }); 
    $('.delete-btn').click(function() {
        var selectedIds = $('.check-item:checked').map(function() {
            return $(this).val();
        }).get();
        $('#selectedIds').val(selectedIds.join(','));
        // Set the value of hidden input field with selected IDs
        
    });
    // Function to handle form submission for updating status
    $('#DeleteForm').submit(function(event) {
        // event.preventDefault(); // Prevent default form submission
        
        var formData = $(this).serialize(); // Serialize form data
        // Send AJAX request to update status
        $.ajax({
            type: 'POST',
            url: 'deletenewcom.php',
            data: formData,
            success: function(response) {
             
                // Handle success
                console.log(response);
                // window.location.reload();
            
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('Error updating status!');
                console.error(error);
            }
        });
    }); 
    
    
    
    


    });
</script>
<div class="modal fade" id="updateStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-balance-scale nav-icon"></i> Update status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
      <form id="updateStatusForm" method="POST">
                    <input type="hidden" name="selectedIdss" id="selectedIdss" value="">
                    <select name="complaint_status" class="form-control" id="" required>
                      <option value="0">Pending</option>
                      <option value="1">On Process</option>
                      <option value="2">Rejected</option>
                      <option value="3">Solved</option>
                    </select>
                    <div class="modal-footer alert-light">
                        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                        <button type="submit" class="btn bg-primary" name="update_blotter_status"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                    </div>
                </form>
    </div>
  </div>
</div>

<?php require_once '../includes/footer.php'; ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->