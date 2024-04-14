<title>Concern and Complaint Reporting System | Code verification</title>
<?php require_once 'header.php'; ?>
<div class="content m-5">
  <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>Enter security </b>code</a>
      </div>
      <div class="card-body">
        <?php
        if(isset($_GET['type']) && isset($_GET['user_Id']) && isset($_GET['contact'])) {
          $type    = $_GET['type'];
          $user_Id = $_GET['user_Id'];
          $contact   = $_GET['contact'];
          $get_u = mysqli_query($conn, "SELECT * FROM users WHERE user_Id=$user_Id");
          $row = mysqli_fetch_array($get_u);
          if($type == 'account-verification') {
        ?>
          <p class="login-box-msg">Please check your email for a message with your code. Your code is 6 numbers long.</p>
          <form action="processes.php" method="POST">
            <input type="hidden" class="form-control mb-3" value="<?php echo $user_Id; ?>" name="user_Id">
            <input type="hidden" class="form-control mb-3" value="<?php echo $contact; ?>" name="contact">
            <div class="input-group mb-3">
              <input type="number" class="form-control" placeholder="Enter verification code" name="code" minlength="6" maxlength="6" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group">
              <p>We sent your code to: <br>
                 <b>Contact:</b> +63 <?php echo $row['contact']; ?> <br>
               </p>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn bg-gradient-primary btn-block"  name="verify_account">Continue</button>
                <p>Didn't get a code? Click <a href="login.php">Login</a></p>
              </div>
            </div>
          </form>
        <?php

          } elseif($type == 'account-recovery') {
        ?>
          <p class="login-box-msg">Please check your email for a message with your code. Your code is 6 numbers long.</p>
          <form action="processes.php" method="POST">
            <input type="hidden" class="form-control mb-3" value="<?php echo $user_Id; ?>" name="user_Id">
            <input type="hidden" class="form-control mb-3" value="<?php echo $contact; ?>" name="contact">
            <div class="input-group mb-3">
              <input type="number" class="form-control" placeholder="Enter verification code" name="code" minlength="4" maxlength="4" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group">
              <p>We sent your code to: <b>+63<?php echo $contact; ?></b></p>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn bg-gradient-primary btn-block"  name="verify_code">Continue</button>
                <a href="sendcode.php?user_Id=<?php echo $user_Id; ?>" >Didn't get a code?</a>
              </div>
            </div>
          </form>
          <p>
            <a href="login.php">Login</a>
          </p>
        <?php
          } else {
            require_once '404.php';
          }
          
        ?>
        
        <?php } else { require_once '404.php'; } ?>
      </div>
    </div>
  </div>
</div>
<?php require_once 'footer.php'; ?>