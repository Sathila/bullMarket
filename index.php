<?php 
  session_start();
  include('includes/config.php');
  error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>BULL MARKET</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
  </head>
  <body>  
    <!--Header-->
    <?php include('includes/header.php');?>
    <!-- /Header --> 
    <!-- Banners -->
    <section id="banner" class="banner-section">
      <div class="container">
        <div class="div_zindex">
          <div class="row">
            <div class="col-md-5 col-md-push-7">
              <div class="banner_content">
                <h1>GAME ON</h1>
                <p>IT'S ALL ABOUT MAKING YOU A WINNER</p>
                <a href="#signupform" data-toggle="modal" data-dismiss="modal" class="btn">Sign Up Now<span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Banners --> 
    <!-- Body-->
    
    <!-- Fun Facts-->
    <!-- <section class="fun-facts-section">
      <div class="container div_zindex">
        <div class="row">
          <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-m">
              <div class="cell">
                <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
                <p>Years In Business</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-m">
              <div class="cell">
                <h2><i class="fa fa-car" aria-hidden="true"></i>1200+</h2>
                <p>New Cars For Sale</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-m">
              <div class="cell">
                <h2><i class="fa fa-car" aria-hidden="true"></i>1000+</h2>
                <p>Used Cars For Sale</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xs-6 col-sm-3">
            <div class="fun-facts-m">
              <div class="cell">
                <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>600+</h2>
                <p>Satisfied Customers</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="dark-overlay"></div>
    </section> -->
    <!-- /Fun Facts--> 

    <!--Testimonial -->
    <section class="section-padding testimonial-section parallex-bg">
      <div class="container div_zindex">
        <div class="section-header white-text text-center">
          <h2>SELECT A <span>GAME</span></h2>
        </div>
        <div class="row">
          <div id="testimonial-slider">
            <?php 
            $tid=1;
            $sql = "SELECT tbltestimonial.Testimonial,tblusers.FullName from tbltestimonial join tblusers on tbltestimonial.UserEmail=tblusers.EmailId where tbltestimonial.status=:tid";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':tid',$tid, PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;

            if($query->rowCount() > 0)
            {
              foreach($results as $result)
              {  ?>
                <a href="purchase.php">
                  <div class="testimonial-m">
                    <div class="testimonial-img"> <img src="assets/images/cat-profile.png" alt="" /> </div>
                    <div class="testimonial-content">
                      <div class="testimonial-heading">
                        <h5><?php echo htmlentities($result->FullName);?></h5>
                        <p><?php echo htmlentities($result->Testimonial);?></p>
                      </div>
                    </div>
                  </div>
                </a>
              <?php 
              }
            } ?>
          </div>
        </div>
      </div>
      <div class="dark-overlay"></div>
    </section>
    <!-- /Testimonial--> 

    <!--Footer -->
    <?php include('includes/footer.php');?>
    <!-- /Footer--> 

    <!--Back to top-->
    <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
    <!--/Back to top--> 

    <!--Login-Form -->
    <?php include('includes/login.php');?>
    <!--/Login-Form --> 

    <!--Register-Form -->
    <?php include('includes/registration.php');?>
    <!--/Register-Form --> 

    <!--Forgot-password-Form -->
    <?php include('includes/forgotpassword.php');?>
    <!--/Forgot-password-Form --> 

    <!-- Scripts --> 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script> 
    <script src="assets/js/interface.js"></script> 
    <!--Switcher-->
    <script src="assets/switcher/js/switcher.js"></script>
    <!--bootstrap-slider-JS--> 
    <script src="assets/js/bootstrap-slider.min.js"></script> 
    <!--Slider-JS--> 
    <script src="assets/js/slick.min.js"></script> 
    <script src="assets/js/owl.carousel.min.js"></script>

  </body>
</html>