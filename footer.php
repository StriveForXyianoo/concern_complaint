<br>
<br>
<br>
 <footer class="main-footer">
    <div class="row p-3">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Mission</label>
        <p class="text-sm text-justify text-muted">Our mission is to empower communities by providing a web-based platform for reporting concerns and complaints related to safety, fostering transparency, accountability, and collaboration among residents, law enforcement, and local authorities.</p>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Vision</label>
        <p class="text-sm text-justify text-muted">We envision safer communities where every member feels heard and supported, leading to proactive problem-solving, effective resource allocation, and ultimately, a more secure and harmonious society.</p>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Contact Us</label>
        <p class="text-sm text-justify text-muted"><i class="fas fa-phone"></i>  +63 9958242456</p>
        <p class="text-sm text-justify text-muted"><i class="fas fa-envelope"></i>  acalitbinmaley@gmail.com</p>
      </div>
    </div>
    <div class="dropdown-divider"></div>
    <strong>Copyright &copy; 2024 <a href="#">Concern and Complaint Reporting System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
  
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- Custom JS -->
  <script src="dist/js/script.js"></script>
  <!-- SweetAlert Message -->
  <script src="dist/js/sweetalert2.min.js"></script>
  <?php if(isset($_SESSION['message']) && isset($_SESSION['text']) && isset($_SESSION['status'])) { ?>
    <script>
      swal ({
        title: '<?php echo $_SESSION['message']; ?>',
        text: "<?php echo $_SESSION['text']; ?>",
        icon: "<?php echo $_SESSION['status']; ?>",
        confirmButtonColor: '#3085d6',
        confirmButtonText: "Okay",
        timer: 3000
      });
    </script>
  <?php unset($_SESSION['message']); unset($_SESSION['text']); unset($_SESSION['status']); } ?>
  </div>
</body>
</html>