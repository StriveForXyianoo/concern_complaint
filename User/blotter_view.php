<title>Concern and Complaint Reporting System | Blotter images</title>
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
            <li class="breadcrumb-item active">Blotter images</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="content">
    <div class="container">
          <!-- /.col -->
        <?php 
          if(isset($_GET['blotter_Id'])) {
            $blotter_Id = $_GET['blotter_Id'];
            $fetch = mysqli_query($conn, "SELECT * FROM blotter WHERE blotter_Id='$blotter_Id'");
            $row = mysqli_fetch_array($fetch);

            $attachments = explode(",", $row['attachments']);
        ?>
        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body p-3">
                <!-- Additional Details -->
                <div class="mt-3">
                  <h5>Complaint Details</h5>
                  <p><strong>Complainant:</strong> <?= ucwords($row['c_firstname'] . ' ' . $row['c_middlename'] . ' ' . $row['c_lastname'] . ' ' . $row['c_suffix']) ?></p>
                  <p><strong>Contact:</strong> <?= $row['c_contact'] ?></p>
                  <p><strong>Address:</strong> <?= ucwords($row['c_address']) ?></p>
                  <hr>
                  <h5>Accused Person Details</h5>
                  <p><strong>Accused Person:</strong> <?= ucwords($row['acc_firstname'] . ' ' . $row['acc_middlename'] . ' ' . $row['acc_lastname'] . ' ' . $row['acc_suffix']) ?></p>
                  <p><strong>Address:</strong> <?= ucwords($row['acc_address']) ?></p>
                  <hr>
                  <h5>Incident Details</h5>
                  <p><strong>Date:</strong> <?= date('F j, Y', strtotime($row['incidentDate'])) ?></p>
                  <p><strong>Time:</strong> <?= date('h:i A', strtotime($row['incidentTime'])) ?></p>
                  <p><strong>Nature of Incident:</strong> <?= ucwords($row['incidentNature']) ?></p>
                  <p><strong>Incident Address:</strong> <?= ucwords($row['incidentAddress']) ?></p>
                  <hr>
                  <h5>Witnesses</h5>
                  <p><strong>Witnesses:</strong> <?= ucwords($row['witnesses']) ?></p>
                  <hr>
                  <h5>Incident Description</h5>
                  <p><?= nl2br(ucwords($row['incidentDescription'])) ?></p>
                </div>
              </div>
              
              
            </div>
          </div>
        
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body p-3">
                   
                    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            // Display the images in the carousel
                            foreach ($attachments as $key => $filename) {
                                $activeClass = ($key === 0) ? 'active' : '';
                                echo '<div class="carousel-item ' . $activeClass . '">
                                        <img class="d-block w-100" src="../images-blotter/' . $filename . '" alt="Blotter Image">
                                    </div>';
                            }
                            ?>
                        </div>

                        <!-- Carousel Controls -->
                        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

              </div>
                </div>
              </div>
              </div>
              <?php 
                } else {

                }
              ?>
    </div>
  </div>
</div>

<?php require_once 'footer.php'; ?>