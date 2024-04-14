<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web-based School Canteen Reservation Management System | Food Products Information</title>
  <link href="assets/dist/css/main.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <?php 
  require_once 'header.php'; 
  ?>
  <style>
    .hero {
      background-image: url('images/barangay2.jpg');
      background-size: cover;
/*      background-position: center;*/
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-align: center;
      position: relative;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Adjust the last value (0.5) for opacity */
    }

    .cover-image {
      background-image: url('images/barangay2.jpg');
      background-size: cover;
      background-position: center;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-align: center;
      position: relative;
    }

    .cover-image::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5); /* Adjust the last value (0.5) for opacity */
    }

    .cover-text {
      font-size: 45px;
      text-transform: uppercase;
      position: relative;
      z-index: 1;
      color: #fff;
    }
  </style>
</head>
<body>

 <section id="hero" class="hero d-flex align-items-center section-bg" style="margin-top: -110px;">
    <div class="container">
      <div class="row justify-content-center d-flex text-center gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center  ">
         <h2 data-aos="fade-up" class=" text-white">Welcome to<br> Concern and Complaint Reporting System</h2>
         <p data-aos="fade-up" data-aos-delay="100" class="text-center text-white">Empowering Communities, Connecting Lives</p>
        </div>
        <!-- <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="images/barangay2.jpg" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div> -->
      </div>
    </div>
  </section>

  <!-- <section id="hero" class="hero d-flex align-items-center section-bg" style="margin-top: -110px;">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start ">
          <h1>Web-based School Canteen Reservation Management System</h1>
          <h2 data-aos="fade-up" class=" text-white">Enjoy Your Healthy<br>Delicious Food</h2>
         <p data-aos="fade-up" data-aos-delay="100" class=" text-white">Experience the delight of savoring nutritious and delicious meals. Indulge in the pleasure of flavors that follow, creating a memorable dining experience. Discover a menu that seeks the finest and satisfies your culinary desires.</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="allproducts.php" class="btn-book-a-table">Reserve No</a>
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="assets/images/hero-img.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section> -->

  <!-- ======= About Section ======= -->
    <section id="about" class="about mt-5">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <!-- <p>Learn More <span>About Us</span></p> -->
        </div>

        <div class="row gy-4">
          <div class="col-12">
            <p class="text-justify">Calit is a barangay in the Municipality of Binmaley, in the province of Pangasinan. Its population as determined by the 2020 Census was 2,517. This represented 2.90% of the total population of Binmaley. The household population of Calit in the 2015 Census was 2,420 broken down into 560 households or an average of 4.32 members per household.</p>
            <p class="text-bold">Barangay Captain: Tony D. Ferrer</p>
          </div>
          <div class="col-lg-7 position-relative about-img" style="background-image: url(images/barangay2.jpg);" data-aos="fade-up" data-aos-delay="150">
          </div>
          <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                Our system provides a comprehensive solution for managing Barangay information efficiently. Here are some key features:
              </p>
              <ul>
                  <li>Easy access to resident records</li>
                  <li>Efficient management of community events and announcements</li>
                  <li>Quick response to complaints and concerns through our integrated reporting system</li>
                  <li>Transparent and accountable governance</li>
              </ul>
              <p>Feel free to explore and utilize the system to enhance the quality of life in our community.</p>

              <div class="position-relative mt-4">
                <img src="assets/images/about-2.jpg" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
<!-- End About Section -->


<!-- ======= Complaint Section ======= -->
  <section id="about" class="about mt-5">
    <div class="container" data-aos="fade-up">
      <div class="section-header mt-5">
        <h2>How to Report a Complaint</h2>
      </div>
      <div class="row gy-4">
        <div class="col-12">
          <ol>
            <li>Contact the Barangay Office:</li>
            <p>Reach out to the Barangay office through phone or visit in person to report your complaint.</p>
            <li>Provide Details:</li>
            <p>Clearly explain the nature of your complaint, including relevant details such as date, time, and location of the incident.</p>
            <li>Submit Supporting Documents:</li>
            <p>If applicable, attach any supporting documents, photos, or evidence that can help in the investigation of your complaint.</p>
          </ol>
        </div>
      </div>
    </div>
  </section>
<!-- End Complaint Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact mt-5">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Need Help? <span>Contact Us</span></p>
        </div>

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-map flex-shrink-0"></i>
              <div>
                <h5>Our Address</h5>
                <p class="text-sm">Calit Binmaley, Pangasinan</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h5>Email Us</h5>
                <p class="text-sm">admin@gmail.com</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h5>Call Us</h5>
                <p class="text-sm">+63 9312181164</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-share flex-shrink-0"></i>
              <div>
                <h5>Opening Hours</h5>
                <div class="text-sm"><strong>Mon-Sat:</strong> 08AM - 05PM;
                  <strong>Sunday:</strong> Closed
                </div>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

       <!--  <form action="forms/contact.php" method="post" role="form" class="php-email-form p-3 p-md-4">
          <div class="row">
            <div class="col-xl-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-xl-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form> -->
        <!--End Contact Form -->

      </div>
    </section><!-- End Contact Section -->

 <!--  <div class="cover-image">
    <div class="cover-text text-white">
      <b>School Canteen Reservation System</b>
    </div>
  </div> -->

  <?php include 'footer.php'; ?>
