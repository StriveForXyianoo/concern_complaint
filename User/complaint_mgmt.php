<title>Concern and Complaint Reporting System | Manage Complaints</title>
<?php 
    require_once 'header.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
?>

<div class="content-wrapper">
  <?php if($page === 'create') { ?>
  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Complaint</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Complaint Add</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
      <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="added_by" value="<?php echo $id; ?>">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Fill-in the required fields below</h3>
              <div class="card-tools mt-2">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12 mb-2">
                  <a class="h5 text-primary"><b>Incident Details</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Nature of Complaint</b></span>
                      <textarea class="form-control" id="" cols="30" rows="2" placeholder="Brief description of the complaint or issue" name="complaint_nature" required></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Location of Incident</b></span>
                      <textarea class="form-control" id="" cols="30" rows="1" placeholder="Specific address or area where the incident occurred" name="incident_location" required></textarea>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Date of the incident</b></span>
                      <input type="date" class="form-control"  placeholder="Family Head Name" name="date_happened" required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Time of the incident</b></span>
                      <input type="time" class="form-control"  placeholder="Family Head Name" name="time_happened" required>
                    </div>
                </div>
                        
                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Witness Information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Name/s of Witnesses</b></span>
                      <input type="text" class="form-control"  placeholder="Full name of any witnesses to the incident" name="witness" required>
                    </div>
                </div>

                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Description of the Incident</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Narrative or description of what happened</b></span>
                      <textarea class="form-control" id="" cols="30" rows="2" placeholder="Detailed information about the complaint, including any relevant background information, and specific concerns" name="details" required></textarea>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Preferred solution</b></span>
                      <textarea class="form-control" id="" cols="30" rows="2" placeholder="What resolution or action is the complainant seeking?" name="preferred_solution" required></textarea>
                    </div>
                </div>

                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Attach any relevant documents or evidence (Photos)</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Attachments</b></span>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload[]" onchange="getImagePreview(event)" multiple required>
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
                </div>
                 <!-- LOAD IMAGE PREVIEW -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group" id="preview">
                    </div>
                </div>
              </div>
              <!-- END ROW -->
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right btn-sm" name="create_complaint" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
              <a href="complaint.php" class="btn btn-secondary float-right btn-sm mr-1"><i class="fa-solid fa-backward"></i> Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    </div>
  </section>
  <?php } else { 
    $complaint_ID = $page;
    $fetch = mysqli_query($conn, "SELECT * FROM complaint WHERE complaint_ID='$complaint_ID'");
    $row = mysqli_fetch_array($fetch);
  ?>
  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Complaint</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Complaint Update</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
   <section class="content">
      <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="complaint_ID" required value="<?php echo $row['complaint_ID']; ?>">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Fill-in the required fields below</h3>
              <div class="card-tools mt-2">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12 mb-2">
                  <a class="h5 text-primary"><b>Incident Details</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Nature of Complaint</b></span>
                      <textarea class="form-control" id="" cols="30" rows="2" placeholder="Brief description of the complaint or issue" name="complaint_nature" required><?= $row['complaint_nature'] ?></textarea>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Location of Incident</b></span>
                      <textarea class="form-control" id="" cols="30" rows="1" placeholder="Specific address or area where the incident occurred" name="incident_location" required><?= $row['incident_location'] ?></textarea>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Date of the incident</b></span>
                      <input type="date" class="form-control"  placeholder="Family Head Name" name="date_happened" required value="<?= $row['date_happened'] ?>">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Time of the incident</b></span>
                      <input type="time" class="form-control"  placeholder="Family Head Name" name="time_happened" required value="<?= $row['time_happened'] ?>">
                    </div>
                </div>
                        
                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Witness Information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Name/s of Witnesses</b></span>
                      <input type="text" class="form-control"  placeholder="Full name of any witnesses to the incident" name="witness" required value="<?= $row['witness'] ?>">
                    </div>
                </div>

                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Description of the Incident</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Narrative or description of what happened</b></span>
                      <textarea class="form-control" id="" cols="30" rows="2" placeholder="Detailed information about the complaint, including any relevant background information, and specific concerns" name="details" required><?= $row['details'] ?></textarea>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Preferred solution</b></span>
                      <textarea class="form-control" id="" cols="30" rows="2" placeholder="What resolution or action is the complainant seeking?" name="preferred_solution" required><?= $row['preferred_solution'] ?></textarea>
                    </div>
                </div>

                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Attach any relevant documents or evidence (Photos)</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                    <div class="form-group">
                      <span class="text-dark"><b>Attachments</b></span>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload[]" onchange="getImagePreview(event)" multiple>
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
                </div>
                 <!-- LOAD IMAGE PREVIEW -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2">
                    <div class="form-group" id="preview">
                    </div>
                </div>
              </div>
              <!-- END ROW -->
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right btn-sm" name="update_complaint" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
              <a href="complaint.php" class="btn btn-secondary float-right btn-sm mr-1"><i class="fa-solid fa-backward"></i> Cancel</a>
              
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <?php } } else { require_once '../includes/404.php'; } ?>
<br>
<br>
<br>
<?php require_once '../includes/footer.php'; ?>