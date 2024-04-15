<title>Concern and Complaint Reporting System | Blotter records</title>
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
            <h3>Blotter</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Blotter Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <!-- DELETE -->
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
      <form action="deletenewblotter.php" method="POST">
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
                <a href="blotter_add.php" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Blotter</a>
                         
                          <button type="button" class="btn bg-danger btn-sm float-right mr-2 disabled delete-btn" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i> Delete </button>
                          <button type="button" class="btn bg-warning btn-sm float-right mr-2 disabled status-btn" ><i class="fas fa-pencil-alt"></i> Status</button>
                          <a class="btn btn-primary btn-sm float-right mr-2 disabled view-btn" href="" ><i class="fas fa-folder"></i> View</a>
                <!-- <a href="export.php?export=blotter" class="btn btn-sm bg-success float-right mr-2"><i class="fa-solid fa-file-excel"></i> Export</a> -->
                <!-- <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div> -->
              </div>
              <div class="card-body p-3">
                 <!-- <table id="example1" class="table table-bordered table-hover text-sm"> -->
                  
                 <table id="example1" class="table table-bordered table-hover text-sm">
                 
                 

                
                  <thead>
                          
                          
                          


                          <tr> 
                    <th></th>
                    <th>COMPLAINANTS</th>
                    <th>ACCUSED/SUBJECT</th>
                    <th>INCIDENT NATURE</th>
                    <th>INCIDENT DATETIME</th>
                    <th>INCIDENT ADDRESS</th>
                    <th>STATUS</th>
                   
                    <!-- <th>TOOLS</th> -->
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM blotter ORDER BY incidentDate");
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td class="text-center">
                        <div class="icheck-primary">
                            <input type="checkbox" value="<?= $row['blotter_Id']; ?>" class="check-item" id="check<?= $row['blotter_Id']; ?>">
                            <label for="check<?= $row2['blotter_Id']; ?>"></label>
                        </div>
                        </td>
                        <td><?php echo ucwords($row['c_firstname'].' '.$row['c_middlename'].' '.$row['c_lastname'].' '.$row['c_suffix']); ?></td>
                        <td><?php echo ucwords($row['acc_firstname'].' '.$row['acc_middlename'].' '.$row['acc_lastname'].' '.$row['acc_suffix']); ?></td>
                        <td><?php echo ucwords($row['incidentNature']); ?></td>
                        <td><?php echo date("F d, Y",strtotime($row['incidentDate'])).' '.$row['incidentTime']; ?></td>
                        <td><?php echo ucwords($row['incidentAddress']); ?></td>
                      <!--   <td>
                          <?php 
                            // if($row['blotter_status'] == 0) {
                            //   echo '<span class="badge badge-info">Open</span>';
                            // } elseif($row['blotter_status'] == 1) {
                            //   echo '<span class="badge badge-success">Closed</span>';
                            // } else {
                            //   echo '<span class="badge badge-warning">Under Investigation</span>';
                            // }
                          ?>
                        </td> -->
                        <td><?php
                        if($row['blotter_status']=='0'){
                          echo '<span class="badge badge-info">Open</span>';
                        }elseif($row['blotter_status']=='1'){
                          echo '<span class="badge badge-success">Closed</span>';
                        }else{
                          echo '<span class="badge badge-warning">Under Investigation</span>';
                        }
                        
                        
                        
                        
                        ?>
                          
                         
                        </td> 
                    </tr>
                    <?php } ?>
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
  <script src="../dist/js/script.js"></script>
<!-- SweetAlert Message -->
<script src="../dist/js/sweetalert2.min.js"></script>
  
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
                $('.view-btn').attr('href', 'blotter_view.php?blotter_Id=' + blotterId);
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
        $('#selectedIdss').val(selectedIds);
        // Set the value of hidden input field with selected IDs
        $('#updateStatus').modal('show'); // Show the modal
    });

  
    $('.delete-btn').click(function() {
        var selectedIds = $('.check-item:checked').map(function() {
            return $(this).val();
        }).get();
        $('#selectedIds').val(selectedIds.join(','));
        // Set the value of hidden input field with selected IDs
        
    });
    
  
    
    
    
    


    });
</script>
<!-- STATUS -->
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
      <form action="updatenewblotter.php" method="POST">
                    <input type="hidden" name="selectedIdss" id="selectedIdss" value="">
                    <select name="blotter_status" class="form-control" required>
                        <option value="0">Open</option>
                        <option value="1">Close</option>
                        <option value="2">Under Investigation</option>
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