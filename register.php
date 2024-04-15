<title>Concern and Complaint Reporting System | Register</title>
<?php require_once 'header.php';?>
  <style>
                    .card-body {
    position: relative;
}

.image {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 70%; /* Adjust as needed */
    height: 70%; /* Adjust as needed */
    /* background-image: url('images/logo.png'); */
    background-size: contain;
    background-position: center center; /* Center the background image */
    opacity: 0.1;
    background-repeat: no-repeat;
    filter: blur(2px);
    transform: translate(-50%, -50%); /* Center the div */
}


</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row d-flex justify-content-center">

          <div class="col-lg-10 mt-5">
            <form action="processes.php" method="POST" enctype="multipart/form-data">
            <div class="card card-outline card-primary">
              <div class="card-header text-center">
                <a href="#" class="h1"><b>Registration</b></a>
              </div>
                <div class="card-body">
                
                  <div class="image"></div>
                    <div class="row">

                        <div class="col-lg-12 mt-1 mb-2">
                          <a class="h5 text-primary"><b>Basic information</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        <!-- <div class="col-12">
                          <div class="row">
                            <div class="col-lg-4 col col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                <span class="text-dark"><b>Username</b></span>
                                <input type="text" class="form-control"  placeholder="Username" name="username" required>
                              </div>
                            </div>
                          </div>
                        </div> -->
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
                              <input type="text" class="form-control bg-light" placeholder="Age" required id="txtage" name="age" readonly>
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
                       <!--  <div class="col-lg-6 col-md-6 col-sm-6 col-12">
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
                          <a class="h5 text-primary"><b>Complete ddress</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Full Address</b></span>
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
                        <div class="col-lg-9 col-md-9 col-sm-9 col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>User's photo (Optional)</b></span>
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
                        <div class="col-lg-3 col-md-3 col-sm-3 col-12">
                          <div class="form-group">
                            <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                            <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                              <img id="imagePreview" src="images/image-holder.png" alt="Image Preview" class="img-fluid" style="width: 100%;">
                            </div>
                          </div>
                        </div>

                        

                    </div>
                    <!-- END ROW -->
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                        <label for="agreeTerms">
                         I agree to the <a href="#" data-toggle="modal" data-target="#terms-conditions">terms</a>
                        </label>
                      </div>
                    </div>
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary float-right" name="create_user" id="submit_button"><i class="fa-solid fa-floppy-disk"></i> Register</button>
                    </div>
                  </div>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->


  <div class="modal fade" id="terms-conditions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <img src="images/logo.png" alt="" class="d-block m-auto img-circle img-fluid shadow-sm" width="100">
        </div>
        <div class="modal-body text-justify">
            <h5 class="modal-title text-center mb-4" id="exampleModalLabel">Terms and Conditions</h5>
            <p>The Web-based Concern and Complaint Reporting System for residents of Barangay Calit is accessible to individuals aged 15 years and older. Registration requires accurate information, with only one account allowed per resident. Users must maintain account confidentiality and use the system solely for reporting local concerns and complaints, refraining from unlawful activities. Submission guidelines mandate truthful information, while respectful communication and confidentiality of data are emphasized to ensure a positive and secure user experience.</p>
            
            <!-- Add more terms and conditions text as needed -->
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php include 'footer.php'; ?>
