<title>Concern and Complaint Reporting System | Blotter</title>
<?php
require_once 'header.php';
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Blotter</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Blotter info</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="card">
              <div class="card-header p-2">
                <a onclick="Choose()" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Blotter</a>
                <div class="card-tools mr-1">
                <a class="btn btn-primary btn-sm view-btn disabled" href="complaint_view.php?complaint_ID="><i class="fas fa-folder"></i> View</a>
                          <a class="btn btn-info btn-sm update-btn disabled" href="complaint_mgmt.php?page="><i class="fas fa-pencil-alt"></i> Update</a>
                          <button type="button" class="btn bg-danger btn-sm delete-btn disabled" onclick="deleteF()"><i class="fas fa-trash"></i> Delete </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <!-- <table id="example1" class="table table-bordered table-hover text-sm"> -->
                 <table id="exampleUser" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th></th>
                    <th>COMPLAINANTS</th>
                    <th>ACCUSED/SUBJECT</th>
                    <th>INCIDENT NATURE</th>
                    <th>INCIDENT DATETIME</th>
                    <th>INCIDENT ADDRESS</th>
                    
                    <!-- <th>TOOLS</th> -->
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM blotter WHERE added_by=$id ORDER BY c_firstname");
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                    <td class="text-center">
                        <div class="icheck-primary">
                              <input type="checkbox" value="<?= $row['blotter_Id']; ?>" class="check-item" id="check<?= $row['blotter_Id']; ?>">
                              <label for="check<?= $row['blotter_Id']; ?>"></label>
                          </div>
                      </td>
                        <td><?php echo ucwords($row['c_firstname'].' '.$row['c_middlename'].' '.$row['c_lastname'].' '.$row['c_suffix']); ?></td>
                        <td><?php echo ucwords($row['acc_firstname'].' '.$row['acc_middlename'].' '.$row['acc_lastname'].' '.$row['acc_suffix']); ?></td>
                        <td><?php echo ucwords($row['incidentNature']); ?></td>
                        <td><?php echo date("F d, Y",strtotime($row['incidentDate'])).' '.$row['incidentTime']; ?></td>
                        <td><?php echo ucwords($row['incidentAddress']); ?></td>
                       
                        
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
    </div>
  </div>
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
        <form action="blotter_add.php" method="POST">
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
        <form action="BlotterDelete.php" method="POST">
          <input type="hidden" class="form-control" value="" name="complaint_ID">
          <h6 class="text-center">Delete blotter record?</h6>
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
                $('.view-btn').attr('href', 'blotter_view.php?blotter_Id=' + blotterId);
                $('.update-btn').attr('href', 'blotter_update.php?blotter_Id=' + blotterId);
               
                $('input[name="complaint_ID"]').val(blotterId);

            }else {
                $('.view-btn').removeAttr('href'); // Remove the href attribute if no checkbox or multiple checkboxes are checked
                $('.update-btn').removeAttr('href'); // Remove the href attribute if no checkbox or multiple checkboxes are checked
                
                $('input[name="complaint_ID"]').val(selected);

                
                
                
               
                
            }
           
            
      });
    
    });
    

  </script>
<?php require_once 'footer.php'; ?>