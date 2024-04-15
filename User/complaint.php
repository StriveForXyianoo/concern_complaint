<title>Concern and Complaint Reporting System | Complaint records</title>
<?php 
    require_once 'header.php'; 
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
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

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <a onclick="Choose()" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Complaint</a>
                <div class="card-tools mr-1">
                          <a class="btn btn-primary btn-sm view-btn disabled" href="complaint_view.php?complaint_ID="><i class="fas fa-folder"></i> View</a>
                          <a class="btn btn-info btn-sm update-btn disabled" href="complaint_mgmt.php?page="><i class="fas fa-pencil-alt"></i> Update</a>
                          <button type="button" class="btn bg-danger btn-sm delete-btn disabled" onclick="deleteF()"><i class="fas fa-trash"></i> Delete </button>
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
                    
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM complaint JOIN users ON complaint.added_by=users.user_Id WHERE complaint.added_by=$id");
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>

                      <td class="text-center">
                        <div class="icheck-primary">
                              <input type="checkbox" value="<?= $row['complaint_ID']; ?>" class="check-item" id="check<?= $row['complaint_ID']; ?>">
                              <label for="check<?= $row['complaint_ID']; ?>"></label>
                          </div>
                      </td>
                        <td><?php echo ucwords($row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']); ?></td>
                        <td><?php echo ucwords($row['complaint_nature']); ?></td>
                        <td><?php echo ucwords($row['incident_location']); ?></td>
                        <td><?php echo date("F d, Y",strtotime($row['date_happened'])).' <br>'.$row['time_happened']; ?></td>
                       <!--  <td>
                          <?php 
                            // if($row['status'] == 0) {
                            //   echo '<span class="badge badge-info">Pending</span>';
                            // } elseif($row['status'] == 1) {
                            //   echo '<span class="badge badge-success">Verified</span>';
                            // } elseif($row['status'] == 2) {
                            //   echo '<span class="badge badge-danger">Rejected</span>';
                            // } else {
                            //   echo '<span class="badge badge-primary">Solved</span>';
                            // }
                          ?>
                        </td> -->
                        
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

  <div class="modal fade" id="lang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-language nav-icon"></i> Select Language</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="complaint_mgmt.php?page=create" method="POST">
          <select name="language" id="" class="form-control">
            <option value="en">English</option>
            <option value="tl">Tagalog</option>
          </select>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-success" name="lang"> Add Complaint</button>
      </div>
        </form>
    </div>
  </div>
</div>

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
        <form action="complainDelete.php" method="POST">
          <input type="hidden" class="form-control" value="" name="complaint_ID">
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function Choose(){
      $('#lang').modal('show');
    }
    function deleteF(){
      $('#delete').modal('show');
    }
  $(document).ready(function(){
      $(document).on('change', '.check-item', function(){
            var checkedCount = $('.check-item:checked').length;
            $('.view-btn,.update-btn,.secure-btn').toggleClass('disabled', checkedCount !== 1);
            if (checkedCount > 0) {
              $('.delete-btn').removeClass('disabled');
              selected=[];
              $('.check-item:checked').each(function(){
                selected.push($(this).val());
              });
             

            } else {
              $('.delete-btn').addClass('disabled');
            }
            
            
            
            // If exactly one checkbox is checked, update the href attribute of the "View" button
            if (checkedCount === 1) {
                var checkedCheckbox = $('.check-item:checked');
                var blotterId = checkedCheckbox.val();
                $('.view-btn').attr('href', 'complaint_view.php?complaint_ID=' + blotterId);
                $('.update-btn').attr('href', 'complaint_mgmt.php?page=' + blotterId);
               
                $('input[name="complaint_ID"]').val(blotterId);

            }else {
                $('.view-btn').removeAttr('href'); // Remove the href attribute if no checkbox or multiple checkboxes are checked
                $('.update-btn').removeAttr('href'); // Remove the href attribute if no checkbox or multiple checkboxes are checked
                
                $('input[name="complaint_ID"]').val(selected);

                
                
                
               
                
            }
           
            
      });
    
    });
    

  </script>
<?php require_once '../includes/footer.php'; ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->