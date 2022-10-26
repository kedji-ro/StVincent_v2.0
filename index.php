<?php
if (session_status() !== PHP_SESSION_NONE) {
  header('Location: dashboard/?event-activity');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>St. Vincent Strambi C.P of Home for the Aged</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="home-assets/img/favicon.png" rel="icon"> -->
  <link href="home-assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="home-assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="home-assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="home-assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="home-assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="home-assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="home-assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="home-assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="#">St. Vincent Strambi</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="home-assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About Us</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <!-- <li style="background-color: white;"><a class="nav-link scrollto" href="#" style="color: black;">Login</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex container-fluid">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
      <div class="row">
        <div class="col-lg-7" style="margin-top:30px ;">
          <h1>St. Vincent <br><span>Strambi C.P</span> <br>of Home for the Aged</h1>
          <h2>WE CARE, WE VALUE.<h2>
              <a href="donation.php" class="btn-get-started scrollto">Donate</a>
        </div>
        <div class="col-lg-5">
          <section style="padding: 0px; background-color: white;">
            <!--========== Login Form ==========-->
            <form action="includes/actions/login.php" method="POST" id="login_form">
              <div class="form-group mt-3">
                <h4 style="text-align: center; margin-top:50px;">Login</h4>
              </div>
              <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                  <div class="form-group mt-3">
                    <div class="text-center mt-3">
                      <?php include 'includes/alert-message.php' ?>
                    </div>
                    <input type="text" name="user" class="form-control" id="user" style="border-radius:0px;" placeholder="Username or Email" required autocomplete="username">
                  </div>
                  <div class="form-group mt-3">
                    <input type="password" name="pass" class="form-control " id="pass" style="border-radius:0px;" placeholder="Password" required autocomplete="current-password">
                  </div>
                  <div class="form-group mt-3 text-center">
                    <button class="btn btn-danger btn-lg" type="submit" style="border-radius:0px;">SIGN IN</button>
                  </div>
                </div>
                <div class="col-sm-2">

                </div>

              </div>

              <div class="form-group mt-3 text-center" style="margin-bottom: 50px;">
                <p>Don't have an account?
                  <br><a onclick="btn_switchSignUp()" href="#">Register Here</a>
                </p>
              </div>
            </form>
            <!-- Login Form End -->

            <!--========== Sign Up Form ==========-->

            <form id="signup_form" action="includes/actions/sign-up.php" method="POST" style="background-color: white; padding: 30px;" oninput='sRePass.setCustomValidity(sRePass.value != sPass.value ? "Passwords do not match." : "")' hidden>
              <div class="form-group mt-3">
                <h4 style="text-align: center;">Register</h4>
              </div>
              <div class="row">
                <div class="text-center mt-3">
                  <?php include 'includes/alert-message.php' ?>
                </div>
                <div class="col-md-6 form-group">
                  <input type="text" name="sName" class="form-control" id="sName" style="border-radius:0px;" placeholder="Full Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" name="sEmail" class="form-control" id="sEmail" style="border-radius:0px;" placeholder="Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" name="sUser" class="form-control" id="sUser" style="border-radius:0px;" placeholder="Username" required>
              </div>
              <div class="form-group mt-3">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="password" name="sPass" class="form-control" id="sPass" style="border-radius:0px;" placeholder="Password" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="password" name="sRePass" class="form-control" id="sRePass" style="border-radius:0px;" placeholder="Re-type Password" required>
                  </div>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" name="sAddress" class="form-control" id="sAddress" style="border-radius:0px;" placeholder="Addresss (Optional)">
              </div>
              <div class="form-group mt-3">
                <input type="text" name="sMobile" class="form-control" id="sAddress" style="border-radius:0px;" placeholder="Mobile (Optional)">
              </div>
              <div class="form-group mt-3 text-center">
                <button class="btn btn-md btn-danger" type="submit" style="border-radius:0px;">CREATE ACCOUNT</button>
              </div>
              <div class="form-group mt-3 text-center">
                <p>Already have an account?
                  <br><a onclick="btn_switchLogin()" href="#">Login Here</a>
                </p>
              </div>
            </form>
          </section>
          <!-- Sign Up Form End -->
        </div>
      </div>

    </div>
  </section>
  <!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-3 order-2 order-lg-1" data-aos="fade-right" style="float:right;">
            <img src="home-assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-1 order-2 order-lg-1" data-aos="fade-right" style="float:right; opacity:0%;">
            <img src="home-assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-1 order-lg-2 content " data-aos="fade-left" style="margin-top: 20px;">
            <h3>History</h3>
            <p class="fst-italic">
              St. Vincent Strambi C.P of Home for the Aged
            </p>
            <p>
              With the common desire to help and extend pastoral works, the concerted efforts of the different
              civic and religious movements, generous individuals, and families were conceived and concretized
              the Home for the Aged on November 7, 1991, which marked the groundbreaking ceremony.
            </p>
          </div>
        </div>

        <div class="row" style="margin: 40px 0px 40px 0px; text-align:center;">
          <div class="col-lg-12 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade">
            <h2>Mission and Vision</h2>
          </div>
        </div>

        <div class="row" style="margin-bottom: 70px; text-align:left;">
          <div class="col-lg-1 pt-4 pt-lg-0 order-1 order-lg-1 content" data-aos="fade-left">
            <div style="background-color: red;">
              <p style="color: red; padding-right:10px;">f<br>f<br>f<br>f</p>
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-left">
            <h3>Our Mission</h3>
            <p>
              We commit ourselves to provide integrated services for the upliftment of the general well-being of the aged.
            </p>
          </div>
        </div>

        <div class="row" style="text-align:right;">
          <div class="col-lg-1 pt-4 pt-lg-0 order-1 order-lg-1 content" data-aos="fade-right">
            <div style="background-color: red;"> </div>
          </div>
          <div class="col-lg-10 pt-4 pt-lg-0 order-2 order-lg-2 content" data-aos="fade-right">
            <h3>Our Vision</h3>
            <p>
              We, the St, Vincent Strambi Home for the Aged, Inc. officers, board members, and personnel founded on the Passionist tradition of sharing the life of
              the crucified One and the crucified ones in the society, envision a quality Residential Care Program to the elderly people ages 60 and above who are
              indigent, neglected and abandoned.
            </p>
          </div>
          <div class="col-lg-1 pt-4 pt-lg-0 order-3 order-lg-3 content" data-aos="fade-right">
            <div style="background-color: red;">
              <p style="color: red; padding-right:10px;">f<br>f<br>f<br>f<br>f</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="text-center">
          <h3>Services</h3>
          <p> It is good to note that St. Vincent Strambi Home for the Aged, Inc. is within the guidance of the Social Service Ministry of the Catholic Women's League (CWL). It is dedicated to take part in uplifting the life and well-being of the indigent and to help them become responsible individuals. It has specific services addressed to disadvantaged individual or group in society to nourish their well-being towards becoming functional and productive persons. In ensuring the holistic development of the clients, support services are being developed to fit with their realities and needs. </p>
          <p> Dictionary defines Program as a plan to actions for achieving something or a set of activities with specific goal. It is a system of procedures or activities that has a specific purpose. Further, dictionary defines Services as set of action to be done to help or facilitate improvement to someone or to a set of people within a given situation.</p>
          <p> The programs and services are being presented according to description and scope to assist the Administrative Council and the concerned personnel in understanding the details of program operations.</p>
        </div>

        <section id="services" class="services">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bxl-dribbble"></i></div>
                  <h4><a href="#">CORE PROGRAM AND SERVICES</a></h4>
                  <p>Core Program refers the primary interventions that are being facilitated in the healing and move, process of a particular client.

St. Vincent Strambi Home for the Aged, Inc. as it continues to facilitate the development and implementation of helping interventions for its clientele identifies it main program with corresponding services. These are Residential Care Program.</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="150">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-file"></i></div>
                  <h4><a href="#">Sed ut perspiciatis</a></h4>
                  <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-tachometer"></i></div>
                  <h4><a href="#">Magni Dolores</a></h4>
                  <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="450">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-world"></i></div>
                  <h4><a href="#">Nemo Enim</a></h4>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="600">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-slideshow"></i></div>
                  <h4><a href="#">Dele cardo</a></h4>
                  <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="750">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-arch"></i></div>
                  <h4><a href="#">Divera don</a></h4>
                  <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="450">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-world"></i></div>
                  <h4><a href="#">Nemo Enim</a></h4>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="600">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-slideshow"></i></div>
                  <h4><a href="#">Dele cardo</a></h4>
                  <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="750">
                <div class="icon-box" style="background-color: rgba(255, 255, 255, 0.5);">
                  <div class="icon"><i class="bx bx-arch"></i></div>
                  <h4><a href="#">Divera don</a></h4>
                  <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                </div>
              </div>

            </div>

          </div>
        </section>

      </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Contact</span>
          <h2>Contact</h2>
          <p>You may reach us through the following</p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>contact@example.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>552-7500 or 553-7593</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        Copyright © 2022 | St. Vincent Strambi C.P of Home for the Aged. All rights reserved.
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="home-assets/vendor/aos/aos.js"></script>
  <script src="home-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="home-assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="home-assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="home-assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="home-assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="home-assets/js/main.js"></script>

  <script src="home-assets/js/functions.js"></script>

</body>

</html>