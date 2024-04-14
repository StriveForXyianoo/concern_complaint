<title>Concern and Complaint Reporting System | Forgot password</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="index.php" class="h1"><b>Find your </b>ACCOUNT</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Please enter your email or mobile number to search for your account.</p>
        <form action="processes.php" method="post">
          <div class="form-group">
            <span class="text-dark"><b>Contact number</b></span>
            <div class="input-group">
              <div class="input-group-text">+63</div>
              <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10">
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn bg-gradient-primary btn-block"  name="search" id="submit_button">Search</button>
            </div>
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="login.php">Login</a>
        </p>
      </div>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>