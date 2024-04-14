<title>Concern and Complaint Reporting System | Login</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary ">
      <div class="card-header text-center">
        <!-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> -->
        <a href="login.php" class="h1">
          <img src="images/logo.png" alt="logo" class="img-fluid shadow-sm img-circle" width="150">

          <!-- UNCOMMENT THIS TO REPLACE NEW LOGO -->
          <!-- <img src="images/image-holder.png" alt="AdminLTE Logo" class="s" style="height: 50px; width:50px; border-radius: 50%;"> -->
        </a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="processes.php" method="post">
          <div class="form-group">
            <span class="text-dark"><b>Contact Number</b></span>
            <div class="input-group">
              <div class="input-group-text">+63</div>
              <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10">
            </div>
          </div>
         
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password" minlength="8" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" onclick="showPassword()">
                <label for="remember">
                  Show Password
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block" name="login" id="submit_button">Sign In</button>
            </div>
          </div>
        </form>
        <!-- <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> -->
        <p class="mb-1">
          <a href="forgot-password.php">Forgot password?</a>
        </p>
        <p class="mb-0">
          No account? <a href="register.php" class="text-center">Register here!</a>
        </p>
      </div>
    </div>
  </div>
</div>

<?php require_once 'footer.php'; ?>
