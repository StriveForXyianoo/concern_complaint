<title>Concern and Complaint Reporting System | Manage Administrator</title>
<?php 
    require_once 'sidebar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
?>

<div class="content-wrapper">
  <?php if($page === 'create') { ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrator</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Administrator Add</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
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
                <div class="col-lg-12 mt-1 mb-2">
                  <a class="h5 text-primary"><b>Basic Information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                      <div class="form-group">
                        <div class="form-group">
                          <span class="text-dark"><b>User type</b></span>
                          <select class="form-control" name="user_type" required>
                            <option selected disabled value="">Select type</option>
                            <option value="Staff">Staff</option>
                            <option value="Admin">Admin</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                      <div class="form-group">
                        <span class="text-dark"><b>Username</b></span>
                        <input type="text" class="form-control"  placeholder="Username" name="username" required>
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>First name</b></span>
                    <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)">
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Middle name</b></span>
                    <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)">
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Last name</b></span>
                    <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)">
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Ext/Suffix</b></span>
                    <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Date of Birth</b></span>
                    <input type="date" class="form-control" name="dob" placeholder="Date of birth" required id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Age</b></span>
                    <input type="text" class="form-control bg-white" placeholder="Age" required id="txtage" name="age" readonly>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Sex</b></span>
                    <select class="form-control" name="gender" required>
                      <option selected disabled value="">Select sex</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Contact details</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Email</b></span>
                    <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
                    <small id="text" style="font-style: italic;"></small>
                  </div>
                </div> -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Contact number</b></span>
                    <div class="input-group">
                      <div class="input-group-text">+63</div>
                      <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10">
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Complete address</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Full address</b></span>
                    <textarea name="address" class="form-control" id="" cols="30" rows="2" required></textarea>
                  </div>
                </div>
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Account password</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <span class="text-dark"><b>Password</b></span>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8">
                            <div class="input-group-append">
                                <span class="input-group-text" id="eye-toggle-password" onclick="togglePasswordVisibility('password')">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <span class="text-dark"><b>Confirm password</b></span>
                        <div class="input-group">
                            <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_confirm_password()" required minlength="8">
                            <div class="input-group-append">
                                <span class="input-group-text" id="eye-toggle-cpassword" onclick="togglePasswordVisibility('cpassword')">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        <small id="wrong_pass_alert" class="text-bold" style="font-style: italic; font-size: 12px;"></small>
                    </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Additional information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Administrator's photo (Optional)</b></span>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     <!--  <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
                    </div>
                    <p class="help-block text-danger">Max. 500KB</p>
                  </div>
                </div>
                <!-- LOAD IMAGE PREVIEW -->
                <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                  <div class="form-group">
                    <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                    <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                      <img id="imagePreview" src="../images/image-holder.png" alt="Image Preview" class="img-fluid" style="width: 100%;">
                    </div>
                  </div>
                </div>
              </div>
              <!-- END ROW -->
            </div>
            <div class="card-footer">
              <a href="admin.php" class="btn btn-secondary"><i class="fa-solid fa-backward"></i> Cancel</a>
              <button type="submit" class="btn btn-primary float-right" name="create_admin" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <?php } else { 
    $user_Id = $page;
    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
    $row = mysqli_fetch_array($fetch);
  ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administrator</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Administrator Update</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="user_Id" required value="<?php echo $row['user_Id']; ?>">
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
                <div class="col-lg-12 mt-1 mb-2">
                  <a class="h5 text-primary"><b>Basic information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-12">
                  <div class="row">
                    <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                      <div class="form-group">
                        <?php
                        $user_types = ['Staff', 'Admin'];
                        $selecteduser_type = $row['user_type']; // Assuming $row contains the data for the current user
                        ?>
                        <span class="text-dark"><b>Usertype</b></span>
                        <select class="form-control" name="user_type" required>
                          <option selected disabled value="">Select type</option>
                          <?php foreach ($user_types as $user_type): ?>
                          <option value="<?php echo $user_type; ?>" <?php if ($selecteduser_type === $user_type) { echo 'selected'; } ?>><?php echo $user_type; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <!-- <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                      <div class="form-group">
                        <span class="text-dark"><b>Username</b></span>
                        <input type="text" class="form-control"  placeholder="Username" name="username" required value="<?php echo $row['username']; ?>">
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>First name</b></span>
                    <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)" value="<?php echo $row['firstname']; ?>">
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Middle name</b></span>
                    <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)" value="<?php echo $row['middlename']; ?>">
                  </div>
                </div>
                <div class="col-lg-3 col col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Last name</b></span>
                    <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)" value="<?php echo $row['lastname']; ?>">
                  </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Ext/Suffix</b></span>
                    <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix" value="<?php echo $row['suffix']; ?>">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Date of Birth</b></span>
                    <input type="date" class="form-control" name="dob" placeholder="Date of birth" required id="birthdate" onchange="calculateAge()" value="<?php echo $row['dob']; ?>" max="<?php echo date('Y-m-d'); ?>">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Age</b></span>
                    <input type="text" class="form-control bg-white" placeholder="Age" required id="txtage" name="age" readonly value="<?php echo $ageValue = calculateFormattedAge($row['dob']); ?>">
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <?php
                    $genders = ['Male', 'Female'];
                    $selectedGender = $row['gender'];
                    ?>
                    <span class="text-dark"><b>Sex</b></span>
                    <select class="form-control" name="gender" required>
                      <option selected disabled value="">Select sex</option>
                      <?php foreach ($genders as $gender): ?>
                      <option value="<?php echo $gender; ?>" <?php if ($selectedGender === $gender) { echo 'selected'; } ?>><?php echo $gender; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Contact details</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Email</b></span>
                    <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required value="<?php echo $row['email']; ?>">
                    <small id="text" style="font-style: italic;"></small>
                  </div>
                </div> -->
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Contact number</b></span>
                    <div class="input-group">
                      <div class="input-group-text">+63</div>
                      <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10" value="<?php echo $row['contact']; ?>">
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                  <a class="h5 text-primary"><b>Complete address</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Full address</b></span>
                    <input type="text" class="form-control"  placeholder="Full address" name="address" value="<?php echo $row['address']; ?>">
                  </div>
                </div>
                
                <div class="col-lg-12 mt-3 mb-2">
                  <a class="h5 text-primary"><b>Additional information</b></a>
                  <div class="dropdown-divider"></div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>Administrator's photo</b></span>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     <!--  <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
                    </div>
                    <p class="help-block text-danger">Max. 500KB</p>
                  </div>
                </div>
                <!-- LOAD IMAGE PREVIEW -->
                <div class="col-lg-2 col-md-2 col-sm-3 col-12">
                  <div class="form-group">
                    <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                    <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                      <img id="imagePreview" src="<?php
                          if (!empty($row['image'])) {
                            $imagePath = '../images-users/' . $row['image'];
                            if (file_exists($imagePath)) {
                              echo $imagePath;
                            } else {
                              echo '../images/image-holder.png';
                            }
                          } else {
                            echo '../images/image-holder.png';
                          }
                        ?>" alt="Image Preview" class="img-fluid" style="width: 100%;">

                    </div>
                  </div>
                </div>
              </div>
              <!-- END ROW -->
            </div>
            <div class="card-footer">
              <a href="admin.php" class="btn btn-secondary"><i class="fa-solid fa-backward"></i> Cancel</a>
              <button type="submit" class="btn btn-primary float-right" name="update_admin" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
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