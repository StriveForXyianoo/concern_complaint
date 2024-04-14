<title>Concern and Complaint Reporting System | Dashboard</title>
<?php
require_once 'header.php';
?>
<style>
.card-body .img img {
height: 200px; /* set a fixed height */
object-fit: cover; /* use "cover" to scale the image while maintaining aspect ratio */
}
.card-body .product-image {
height: 200px; /* set a fixed height */
object-fit: cover; /* use "cover" to scale the image while maintaining aspect ratio */
}
</style>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"> Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
              $blotter = mysqli_query($conn, "SELECT blotter_Id from blotter WHERE added_by=$id");
              $row_blotter = mysqli_num_rows($blotter);
              ?>
              <h3><?= $row_blotter ?></h3>
              <p>Blotter Records</p>
            </div>
            <div class="icon">
              <i class="fas fa-balance-scale nav-icon"></i>
            </div>
            <a href="blotter.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $compaint = mysqli_query($conn, "SELECT complaint_ID from complaint WHERE added_by=$id");
              $row_compaint = mysqli_num_rows($compaint);
              ?>
              <h3><?= $row_compaint ?></h3>
              <p>Complaints</p>
            </div>
            <div class="icon">
              <i class="far fa-comment-alt nav-icon"></i>
            </div>
            <a href="complaint.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'footer.php'; ?>