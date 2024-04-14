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
                <a href="complaint_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Complaint</a>
                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                 <!-- <table id="example1" class="table table-bordered table-hover text-sm"> -->
                 <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
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
                      $sql = mysqli_query($conn, "SELECT * FROM complaint JOIN users ON complaint.added_by=users.user_Id WHERE complaint.added_by=$id");
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
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
                        <td>
                          <a class="btn btn-primary btn-xs" href="complaint_view.php?complaint_ID=<?php echo $row['complaint_ID']; ?>"><i class="fas fa-folder"></i> View</a>
                          <a class="btn btn-info btn-xs" href="complaint_mgmt.php?page=<?php echo $row['complaint_ID']; ?>"><i class="fas fa-pencil-alt"></i> Update</a>
                          <button type="button" class="btn bg-danger btn-xs" data-toggle="modal" data-target="#delete<?php echo $row['complaint_ID']; ?>"><i class="fas fa-trash"></i> Delete </button>
                        </td> 
                    </tr>
                  <?php include 'complaint_delete.php'; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php require_once '../includes/footer.php'; ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->