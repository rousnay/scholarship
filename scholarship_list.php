<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Scholarship Management System</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="lib/owlcarousel/owl.carousel.css" rel="stylesheet">
  <link href="lib/owlcarousel/owl.transitions.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">

  <!-- Nivo Slider Theme -->
  <link href="css/nivo-slider-theme.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="css/responsive.css" rel="stylesheet">


  <style type="text/css">
    .scholarship-list {
      background-image: url(img/slider/slider1.jpg);
      background-size: cover;
      background-position: center center;
      position: relative;
      padding: 10% 0;
    }

    .scholarship-list::before {
      content: '';
      position: absolute;
      height: 100%;
      width: 100%;
      background: rgba(50, 50, 50 , 0.4);
      top: 0;
    }

    .status-success{
      text-align:center;
      color:white;
      background-color:#3ec1d5;
      display:inline-block;
      padding:5px 10px
    }
    .status-failed{
      text-align:center;
      color:red;
      background-color:#3ec1d5;
      display:inline-block;
      padding:5px 10px
    }
    .table{
      margin-bottom: 0;
    }
    table .btn {
      width: 70px;
      margin-bottom: 2px;
    }

    thead tr{
      background-color: #337ab7;
      color: white;
    }

    .table-striped>tbody>tr:nth-of-type(even){
      background-color: rgba(207, 235, 255, 0.8);
    }
    .status-reset{
      float: right;
      margin-top: 20px;
    }


  </style>
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <div id="preloader"></div>

  <header>
    <!-- header-area start -->
    <div id="sticker" class="header-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">

            <!-- Navigation -->
            <nav class="navbar navbar-default">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <!-- Brand -->

                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <img src="img/logo.png" alt="" title=""> -->
              </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse main-menu bs-example-navbar-collapse-1" id="navbar-example">
              <ul class="nav navbar-nav navbar-right">
                <li>
                  <a class="page-scroll" href="index.php">Home</a>
                </li>
                <li class="active">
                  <a class="page-scroll" href="scholarship_list.php">Scholarship List</a>
                </li>
                <li>
                  <a class="page-scroll">Student Information</a>
                </li>
                <li>
                  <a class="page-scroll" href="#contact">Contact</a>
                </li>
              </ul>
            </div>
            <!-- navbar-collapse -->
          </nav>
          <!-- END: Navigation -->
        </div>
      </div>
    </div>
  </div>
  <!-- header-area end -->
</header>
<!-- header end -->

<!-- Scholarship Area -->
<div class="scholarship-list">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <!-- layer 1 -->
          <div class="title1"> <h2 style="color: white;"> Scholarship List</h2> </div>


          <?php

          require_once("DBconnect.php");

          if(isset($_GET["id"])){
            $id = $_GET['id'];

            $status = $_GET['status'];


            if($status == 'approve')
            {
              $sql = "UPDATE scholarship_list SET scholarship_status='Approved' WHERE ID = $id";
            }

            elseif ($status == 'decline') {
              $sql = "UPDATE scholarship_list SET scholarship_status='Declined' WHERE ID = $id";
            }

            elseif ($status == 'reset') {
              $sql = "UPDATE scholarship_list SET scholarship_status='Pending'";
            }
            else{
              echo "string";
            }

            if (mysqli_query($conn, $sql)) {
              echo "<h5 class='status-success'> Status updated successfully! </h5>";
            } else {
              echo "<h5 class='status-failed'> Error updating record: " . mysqli_error($conn) . "</h5>";
            }
          }

          ?>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Student Id</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Category</th>
                    <th scope="col">Application Status</th>
                    <th scope="col">Command</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $sql = "SELECT * FROM scholarship_list ORDER BY semester";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) != 0) {
                    while($row=mysqli_fetch_array($result)){
                      ?>

                      <tr>
                        <td><?php echo $row[0]?></td>
                        <td><?php echo $row[1]?></td>
                        <td>@<?php echo $row[2]?></td>
                        <td><?php echo $row[3]?></td>
                        <td>
                          <?php 
                            if($row[4] == "Approved"){
                              echo "<span class='text-success'><strong>" . $row[4] . "</strong></span>";
                            }
                            elseif($row[4] == "Declined"){
                              echo "<span class='text-danger'><strong>" . $row[4] . "</strong></span>";
                            }
                            else{
                              echo "<span class='text-secondary'>" . $row[4] . "</span>";
                            }
                          ?>
                        </td>
                        <td> <a class="btn btn-success btn-sm" href='scholarship_list.php?id=<?php echo $row[5]?>&status=approve'>Approve
                        </a> 
                        <a class="btn btn-danger btn-sm" href='scholarship_list.php?id=<?php echo $row[5]?>&status=decline'>Decline</a> </td>
                      </tr>

                      <?php
                    }
                  }

                  ?> 
                </tbody>
              </table>
            </div>
            <a class="status-reset btn btn-primary" href='scholarship_list.php?id=<?php echo $row[5]?>&status=reset'>Reset Application Status</a>
        </div>
      </div>
    </div>
 
</div>
<!-- End Scholarship Area -->

<!-- Start About area -->
<div id="about" class="about-area area-padding">
  <div class="container">
    <div class="row">

      <!-- End About area -->

      <!-- Start Service area -->


      <!-- End Service area -->

      <!-- our-skill-area start -->
      <div class="our-skill-area fix hidden-sm">
        <div class="test-overly"></div>
        <div class="skill-bg area-padding-2">
          <div class="container">
            <!-- section-heading end -->
            <div class="row">
              <div class="skill-text">
                <!-- single-skill start -->
                <div class="col-xs-12 col-sm-3 col-md-3 text-center">
                  <div class="single-skill">
                    <div class="progress-circular">
                      <input type="text" class="knob" value="0" data-rel="95" data-linecap="round" data-width="175" data-bgcolor="#fff" data-fgcolor="#3EC1D5" data-thickness=".20" data-readonly="true" disabled>
                      <h3 class="progress-h4">CSE</h3>
                    </div>
                  </div>
                </div>
                <!-- single-skill end -->
                <!-- single-skill start -->
                <div class="col-xs-12 col-sm-3 col-md-3 text-center">
                  <div class="single-skill">
                    <div class="progress-circular">
                      <input type="text" class="knob" value="0" data-rel="85" data-linecap="round" data-width="175" data-bgcolor="#fff" data-fgcolor="#3EC1D5" data-thickness=".20" data-readonly="true" disabled>
                      <h3 class="progress-h4">BBS</h3>
                    </div>
                  </div>
                </div>
                <!-- single-skill end -->
                <!-- single-skill start -->
                <div class="col-xs-12 col-sm-3 col-md-3 text-center">
                  <div class="single-skill">
                    <div class="progress-circular">
                      <input type="text" class="knob" value="0" data-rel="75" data-linecap="round" data-width="175" data-bgcolor="#fff" data-fgcolor="#3EC1D5" data-thickness=".20" data-readonly="true" disabled>
                      <h3 class="progress-h4">Architecture</h3>
                    </div>
                  </div>
                </div>
                <!-- single-skill end -->
                <!-- single-skill start -->
                <div class="col-xs-12 col-sm-3 col-md-3 text-center">
                  <div class="single-skill">
                    <div class="progress-circular">
                      <input type="text" class="knob" value="0" data-rel="65" data-linecap="round" data-width="175" data-bgcolor="#fff" data-fgcolor="#3EC1D5" data-thickness=".20" data-readonly="true" disabled>
                      <h3 class="progress-h4">Pharmacy</h3>
                    </div>
                  </div>
                </div>
                <!-- single-skill end -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- our-skill-area end -->

      <!-- Faq area start -->
      <div class="faq-area area-padding">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Faq Question</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="faq-details">
                <div class="panel-group" id="accordion">
                  <!-- Panel Default -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="check-title">
                        <a data-toggle="collapse" class="active" data-parent="#accordion" href="#check1">
                          <span class="acc-icons"></span>Consectetur adipisicing elit.
                        </a>
                      </h4>
                    </div>
                    <div id="check1" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <p>
                          Redug Lefes dolor sit amet, consectetur adipisicing elit. Aspernatur, tempore, commodi quas mollitia dolore magnam quidem repellat, culpa voluptates laboriosam maiores alias accusamus recusandae vero
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- End Panel Default -->
                  <!-- Panel Default -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="check-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#check2">
                          <span class="acc-icons"></span> Dolore magnam quidem repellat.
                        </a>
                      </h4>
                    </div>
                    <div id="check2" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>
                          Redug Lefes dolor sit amet, consectetur adipisicing elit. Aspernatur, tempore, commodi quas mollitia dolore magnam quidem repellat, culpa voluptates laboriosam maiores alias accusamus recusandae vero aperiam sint nulla beatae eos.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- End Panel Default -->
                  <!-- Panel Default -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="check-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#check3">
                          <span class="acc-icons"></span>Redug Lefes dolor sit.
                        </a>
                      </h4>
                    </div>
                    <div id="check3" class="panel-collapse collapse ">
                      <div class="panel-body">
                        <p>
                          Redug Lefes dolor sit amet, consectetur adipisicing elit. Aspernatur, tempore, commodi quas mollitia dolore magnam quidem repellat, culpa voluptates laboriosam maiores alias accusamus recusandae vero aperiam sint nulla beatae eos.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- End Panel Default -->
                  <!-- Panel Default -->
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="check-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#check4">
                          <span class="acc-icons"></span>Maiores alias accusamus
                        </a>
                      </h4>
                    </div>
                    <div id="check4" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p>
                          Redug Lefes dolor sit amet, consectetur adipisicing elit. Aspernatur, tempore, commodi quas mollitia dolore magnam quidem repellat, culpa voluptates laboriosam maiores alias accusamus recusandae vero aperiam sint nulla beatae eos.
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- End Panel Default -->
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="tab-menu">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li class="active">
                    <a href="#p-view-1" role="tab" data-toggle="tab">Data Backup</a>
                  </li>
                  <li>
                    <a href="#p-view-2" role="tab" data-toggle="tab">Password Reset</a>
                  </li>
                  <li>
                    <a href="#p-view-3" role="tab" data-toggle="tab">Result Overview</a>
                  </li>
                </ul>
              </div>
              <div class="tab-content">
                <div class="tab-pane active" id="p-view-1">
                  <div class="tab-inner">
                    <div class="event-content head-team">
                      <h4>Data Backup</h4>
                      <p>
                        Redug Lares dolor sit amet, consectetur adipisicing elit. Animi vero excepturi magnam ducimus adipisci voluptas, praesentium maxime necessitatibus in dolor dolores unde ab, libero quo. Aut, laborum sequi.
                      </p>
                      <p>
                        voluptas, praesentium maxime cum fugiat,magnam ducimus adipisci voluptas, praesentium architecto ducimus, doloribus fuga itaque omnis placeat.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="p-view-2">
                  <div class="tab-inner">
                    <div class="event-content head-team">
                      <h4>Password Reset</h4>
                      <p>
                        voluptas, praesentium maxime cum fugiat,magnam ducimus adipisci voluptas, praesentium architecto ducimus, doloribus fuga itaque omnis.
                      </p>
                      <p>
                        Redug Lares dolor sit amet, consectetur adipisicing elit. Animi vero excepturi magnam ducimus adipisci voluptas, praesentium maxime necessitatibus in dolor dolores unde ab, libero quo. Aut.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="p-view-3">
                  <div class="tab-inner">
                    <div class="event-content head-team">
                      <h4>Result Overview</h4>
                      <p>
                        voluptas, praesentium maxime cum fugiat,magnam ducimus adipisci voluptas, praesentium architecto ducimus, doloribus fuga itaque omnis placeat.
                      </p>
                      <p>
                        voluptas, praesentium maxime cum fugiat,magnam ducimus adipisci voluptas, praesentium architecto ducimus, doloribus fuga itaque omnis.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end Row -->
        </div>
      </div>
      <!-- End Faq Area -->

      <!-- Start Wellcome Area -->


      <div id="contact" class="contact-area">
        <div class="contact-inner area-padding">
          <div class="contact-overly"></div>
          <div class="container ">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                  <h2>Contact With Senior Administrator</h2>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- Start contact icon column -->
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="contact-icon text-center">
                  <div class="single-icon">
                    <i class="fa fa-mobile"></i>
                    <p>
                      Call: +1 5589 55488 55<br>
                      <span>Monday-Friday (9am-5pm)</span>
                    </p>
                  </div>
                </div>
              </div>
              <!-- Start contact icon column -->
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="contact-icon text-center">
                  <div class="single-icon">
                    <i class="fa fa-envelope-o"></i>
                    <p>
                      Email: info@example.com<br>
                      <span>Web: www.example.com</span>
                    </p>
                  </div>
                </div>
              </div>
              <!-- Start contact icon column -->
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="contact-icon text-center">
                  <div class="single-icon">
                    <i class="fa fa-map-marker"></i>
                    <p>
                      Location: A108 Adam Street<br>
                      <span>NY 535022, USA</span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">

              <!-- Start Google Map -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- Start Map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d22864.11283411948!2d-73.96468908098944!3d40.630720240038435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbg!4v1540447494452" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
                <!-- End Map -->
              </div>
              <!-- End Google Map -->

              <!-- Start  contact -->
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form contact-form">
                  <div id="sendmessage">Your message has been sent. Thank you!</div>
                  <div id="errormessage"></div>
                  <form action="" method="post" role="form" class="contactForm">
                    <div class="form-group">
                      <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                      <div class="validation"></div>
                    </div>
                    <div class="text-center"><button type="submit">Send Message</button></div>
                  </form>
                </div>
              </div>
              <!-- End Left contact -->
            </div>
          </div>
        </div>
      </div>
      <!-- End Contact Area -->

      <!-- Start Footer bottom Area -->
      <footer>
        <div class="footer-area">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-4 col-xs-12">
                <div class="footer-content">
                  <div class="footer-head">
                    <div class="footer-logo">
                      <h2>ABC University</h2>
                    </div>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
                    <div class="footer-icons">
                      <ul>
                        <li>
                          <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-google"></i></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end single footer -->
              <div class="col-md-6 col-sm-4 col-xs-12">
                <div class="footer-content">
                  <div class="footer-head">
                    <h4>information</h4>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
                    </p>
                    <div class="footer-contacts">
                      <p><span>Tel:</span> +123 456 789</p>
                      <p><span>Email:</span> contact@example.com</p>
                      <p><span>Working Hours:</span> 9am-5pm</p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end single footer -->

            </div>
          </div>
        </div>
        <div class="footer-area-bottom">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="copyright text-center">
                  <p>
                    &copy; Copyright <strong>ABC University</strong>. All Rights Reserved
                  </p>
                </div>
                <div class="credits">
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=eBusiness
              -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/venobox/venobox.min.js"></script>
  <script src="lib/knob/jquery.knob.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/parallax/parallax.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/nivo-slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
  <script src="lib/appear/jquery.appear.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <script src="js/main.js"></script>
</body>

</html>