<title>LAKASA | Login History</title>

<?php 
    require_once 'header.php'; 
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Login History</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Login History records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>DATE AND TIME LOGGED IN</th>
                    <th>DATE AND TIME LOGGED OUT</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $sql = mysqli_query($conn, "SELECT * FROM log_history WHERE user_Id = '$id' ORDER BY log_ID DESC");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?= date('F d, Y h:i:s A', strtotime($row['login_datetime'])) ?></td>
                    <td>
                        <?php
                        if ($row['logout_datetime'] == '0000-00-00 00:00:00' && $row['logout_remarks'] == 1) {
                            echo '<span class="badge badge-warning">Unable to logout last login</span>';
                        } else {
                            echo $row['logout_datetime'] != '0000-00-00 00:00:00' ? date('F d, Y h:i:s A', strtotime($row['logout_datetime'])) : '<span class="badge badge-success">On-going session</span>';
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
  </div>
</div>
  
<?php require_once 'footer.php'; ?>


