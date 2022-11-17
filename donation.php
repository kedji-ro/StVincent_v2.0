<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Donate - St. Vincent Strambi C.P of Home for the Aged</title>
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

      <h1 class="logo"><a href="index.php">Home</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li> -->
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Donate</li>
        </ol>
        <h2>Donate</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="content">
          <?php include 'includes/alert-message.php'; ?>
          <div class="row text-center mt-3">
            <h2>You can make a difference</h2>
          </div><br>
          <div class="row">
            <div class="container col-md-4 pull-left mt-3" style="border-right: 0.1em solid;">
              <br>
              <img class="mt-3" src="home-assets/img/donate.jpg" alt="" style="max-width: 100%; max-height: 100%; border-radius: 5px;">
            </div>
            <div class="col-md-4" id="don">
              <form action="includes/actions/add-donation.php" method="POST" id="d_form" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group mt-3">
                      <label>Type<span style="color:red;"> *</span></label>
                      <select id="d_type" name="d_type" class="form-control form-select" style="border-radius:0px;">
                        <option selected>Select</option>
                        <option value="Cash">Cash</option>
                        <option value="Check">Check</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group mt-3">
                      <h6 id="chk_bankin" style="font-weight: bold;">Bank Information</h6>
                      <label id="l_amt">Amount <span style="font-style: italic;">(Minimum: 100PHP)</span><span style="color:red;"> *</span></label>
                      <input id="d_amt" name="d_amt" class="form-control" style="border-radius:0px;" type="number" min="100">
                    </div>
                  </div>
                </div>
                <div id="chk_details">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group mt-3">
                        <label>Bank Name</label>
                        <input id="chk_bank" name="chk_bank" class="form-control" style="border-radius:0px;" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group mt-3">
                        <label>Check Refence No.</label>
                        <input id="chk_checkref" name="chk_checkref" class="form-control" style="border-radius:0px;" type="text">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group mt-3">
                      <label>Remarks</label>
                      <textarea id="ad_remarks" name="ad_remarks" rows="5" class="form-control" placeholder="" value="" style="border-radius:0px;"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10">
                    <div class="form-group mt-3">
                      <label>Upload File <span style="font-style: italic;">(JPEG/JPG/PNG)</span></label>
                      <input type="file" id="ad_file" name="ad_file" class="form-control" style="border-radius:0px;" accept="image/*">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mt-3">
                    <button id="a_donation" name="a_donation" type="submit" class="btn btn-info btn-fill pull-left" style="border-radius:0px;">Confirm Donation</button>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-4 pull-left mt-3">
              <h4 style="font-weight:bold;">Bank Details:</h4>
              <p>
                <span style="color:gray;">Bank Name:</span> RCBC <br>
                <span style="color:gray;">Account Number:</span> 0123-4567-8910 <br>
                <span style="color:gray;">Account Name:</span> St. Vincent Strambi C.P <br>
                - <br>
                <span style="color:gray;">Bank Name:</span> Metrobank <br>
                <span style="color:gray;">Account Number:</span> 0123-4567-8910 <br>
                <span style="color:gray;">Account Name:</span> St. Vincent Strambi C.P <br>
              </p>
              <h4 style="font-weight:bold;">GCASH Payment:</h4>
              <p>
                <span style="color:gray;">Account Number:</span> 0912-345-6789 <br>
                <span style="color:gray;">Account Name:</span> St. Vincent Strambi C.P <br>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

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

</body>

<script>
  var type = document.getElementById("d_type");

  var bankin = document.getElementById("chk_bankin");
  var l_amount = document.getElementById("l_amt");
  var amount = document.getElementById("d_amt");

  var bank_details = document.getElementById("chk_details");

  bankin.style.display = "none";
  l_amount.style.display = "none";
  amount.style.display = "none";
  bank_details.style.display = "none";

  document.getElementById("d_type").addEventListener("change", function() {
    if (type.value == 'Cash') {
      l_amount.style.display = "block";
      amount.style.display = "block";

      bankin.style.display = "none";
      bank_details.style.display = "none";
    } else if (type.value == 'Check') {
      l_amount.style.display = "block";
      amount.style.display = "block";

      bankin.style.display = "block";
      bank_details.style.display = "block";
    } else {
      l_amount.style.display = "none";
      amount.style.display = "none";

      bankin.style.display = "none";
      bank_details.style.display = "none";
    }
  });
</script>

</html>