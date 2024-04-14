<title>Concern and Complaint Reporting System | User records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">User records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header p-2">
              <a href="users_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New User</a>
              <div class="card-tools mr-1">
                      <a class="btn btn-primary btn-sm view-btn disabled"><i class="fas fa-folder"></i> View</a>
                      <a class="btn btn-info btn-sm edit-btn disabled" href="users_mgmt.php?page="><i class="fas fa-pencil-alt"></i> Edit</a>
                      <button type="button" class="btn bg-danger btn-sm delete-btn disabled" id="delete-btn" onclick="deleteUser()"><i class="fas fa-trash"></i> Delete</button>
                      <button type="button" class="btn btn-warning btn-sm secure-btn disabled" data-toggle="modal" data-target="#password"><i class="fa-solid fa-lock"></i> Security</button>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th></th>
                    <th>PHOTO</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>CONTACT</th>
                    <th>DATE ADDED</th>
                    
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td class="text-center">
                        <input type="checkbox" value="<?= $row['user_Id']; ?>" class="check-item" id="check<?= $row['user_Id']; ?>">
                        <label for="check<?= $row2['blotter_Id']; ?>"></label>
                    </td>
                    <td>
                      <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                        <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                      </a href="">
                    </td>
                    <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></td>
                   
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
  <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Delete user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="deleteUser.php" method="POST">
          <input type="hidden" class="form-control" name="user_IdHAHA">
          <h6 class="text-center">Delete user record?</h6>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
          <button type="submit" class="btn bg-danger" name="delete_user"><i class="fas fa-trash"></i> Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- CHANGE PASSWORD -->
<div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-lock"></i> Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST">
          <input type="hidden" class="form-control" value="" name="user_Idss">
          <div class="form-group mb-3">
            <label for=""><b>Old password</b></label>
            <input type="password" class="form-control" placeholder="Old password" name="OldPassword" required minlength="8">
          </div>
          <div class="form-group mb-3">
            <label for=""><b>New password</b></label>
            <input type="password" class="form-control" name="password" placeholder="Password" id="password" required minlength="8" onkeypress="validate_password()">
            <small id="passLength"></small>
          </div>
          <div class="form-group mb-3">
            <label for=""><b>Confirm password</b></label>
            <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_confirm_password()" required minlength="8">
            <small id="wrong_pass_alert"></small>
          </div>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
          <button type="submit" class="btn bg-gradient-primary" name="password_user" id="new_create"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    

    function deleteUser(){
      $('#delete').modal('show');
     }
    $(document).ready(function(){
      $(document).on('change', '.check-item', function(){
            var checkedCount = $('.check-item:checked').length;
            $('.view-btn,.edit-btn,.secure-btn').toggleClass('disabled', checkedCount !== 1);
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
                $('.view-btn').attr('href', 'users_view.php?user_Id=' + blotterId);
                $('.edit-btn').attr('href', 'users_mgmt.php?page=' + blotterId);
                $('input[name="user_Idss"]').val(blotterId);
                $('input[name="user_IdHAHA"]').val(blotterId);

            }else {
                $('.view-btn').removeAttr('href'); // Remove the href attribute if no checkbox or multiple checkboxes are checked
                $('.edit-btn').removeAttr('href'); // Remove the href attribute if no checkbox or multiple checkboxes are checked
                $('input[name="user_Idss"]').val('');//user_IdHAHA
                $('input[name="user_IdHAHA"]').val(selected);

                
                
                
               
                
            }
           
            
      });
    
    });
    

  </script>
  <?php require_once '../includes/footer.php'; ?>