<?php
    require_once '../config.php';
    if(isset($_SESSION['user_Id']) && isset($_SESSION['login_time'])) {
      $id = $_SESSION['user_Id'];
      $users = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$id'");
      $row = mysqli_fetch_array($users);

      $login_time = $_SESSION['login_time'];
      // RECORD TIME LOGGED IN TO BE USED IN AUTO LOGOUT - CODE CAN BE FOUND ON ../INCLUDES/FOOTER.PHP
      $_SESSION['last_active'] = time();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CC Report System</title>

    <!---FAVICON ICON FOR WEBSITE--->
    <link rel="shortcut icon" type="image/png" href="../images/logo.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <script src="../plugins/fontawesome-free/js/font-awesome-ni-erwin.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
    body {
    font-family: 'Roboto', sans-serif;
    }
    .form-control:not([type="email"]):not([type="password"]) {
    text-transform: capitalize;
    }
    </style>
  </head>
  <body class="hold-transition layout-top-nav">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
          <a href="dashboard.php" class="navbar-brand">
            <img src="../images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><b>CCRS</b></span>
          </a>
          <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <!-- <li class="nav-item dropdown ">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Books borrowed</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <li><a href="pending.php" class="dropdown-item">Pending</a></li>
                  <li><a href="approved.php" class="dropdown-item">Approved</a></li>
                  <li><a href="released.php" class="dropdown-item">Released</a></li>
                  <li><a href="rejected.php" class="dropdown-item">Rejected</a></li>
                  <li><a href="returned.php" class="dropdown-item">Returned</a></li>
                  <li><a href="unreturned.php" class="dropdown-item">Unreturned</a></li>
                </ul>
              </li> -->
              <li class="nav-item">
               <a href="dashboard.php" class="nav-link" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'color: #007bff;' : ''; ?>">Home</a>

              </li>
              <li class="nav-item">
                <a href="complaint.php" class="nav-link" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'complaint.php' || basename($_SERVER['PHP_SELF']) == 'complaint_mgmt.php' || basename($_SERVER['PHP_SELF']) == 'complaint_view.php') ? 'color: #007bff;' : ''; ?>">Complaints</a>
              </li>
              <li class="nav-item">
                <a href="blotter.php" class="nav-link" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'blotter.php' || basename($_SERVER['PHP_SELF']) == 'blotter_add.php' || basename($_SERVER['PHP_SELF']) == 'blotter_update.php' || basename($_SERVER['PHP_SELF']) == 'blotter_view.php') ? 'color: #007bff;' : ''; ?>">Blotter</a>
              </li>
              <li class="nav-item">
                <a href="log_history.php" class="nav-link" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'log_history.php') ? 'color: #007bff;' : ''; ?>">Log history</a>
              </li>
            </ul>
            <!-- SEARCH FORM -->
            <!-- <form class="form-inline ml-0 ml-md-3 mb-0" action="" method="POST">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search book" name="search_book" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit" name="search_button">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form> -->
          </div>
          <!-- Right navbar links -->
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <!-- <img src="../images-users/<?php echo $row['image']; ?>" alt="User Image" class="mr-3 img-circle" height="50" width="50"> -->
                <img src="../images-users/<?php echo $row['image']; ?>" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?php echo $row['firstname'].' '.$row['lastname']; ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                  <img src="../images-users/<?php echo $row['image']; ?>" class="img-circle elevation-2" alt="User Image">
                  <p>
                    <?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?>
                    <!-- <small><?php echo ucwords($row['username']); ?></small> -->
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-12 text-center">
                      <small>Member since <?php echo date("F d, Y", strtotime($row['created_at'])); ?></small>
                    </div>
                    <!-- <div class="col-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="#">Friends</a>
                    </div> -->
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                  <a href="#" class="btn btn-default btn-flat float-right" onclick="logout()">Sign out</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
              </a>
            </li>
          </ul>
        </div>
      </nav>
<script>

  function logout() {
    swal({
      title: 'Are you sure you want to logout?',
      text: "You won't be able to revert this!",
      icon: "warning",
      buttons: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // Make an AJAX request to the PHP file
        $.ajax({
          url: '../includes/ajax_autoLogout.php',
          type: 'POST',
          data: { 
            id: '<?php echo $id; ?>', 
            login_time: '<?php echo $login_time; ?>',
          },
          success: function(response) {
            // Handle the response if needed
            // swal("Logged out successfully!", {
            //   icon: "success",
            // }).then(() => {
              // Redirect to another page
              window.location = "../logout.php";
            // });
          },
          error: function(xhr, status, error) {
            // Handle the error if needed
            swal("Error occurred while logging out!", {
              icon: "error",
            });
          }
        });
      } else {
        // Handle the cancellation if needed
        swal("Logout canceled.", {
          icon: "info",
        });
      }
    });
  }

</script>

<!-- <script src="../sweetalert2.min.js"></script> -->
<?php //include '../sweetalert_messages.php'; ?>

<?php
  } else {
    header('Location: ../login.php');
    exit();

  }
?>