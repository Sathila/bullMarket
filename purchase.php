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
  <p id="demo"></p>
    <!--Header-->
    <?php include('includes/header.php');?>
    <!-- /Header --> 
    <!-- Banners -->
    <section class="page-header aboutus_page">
      <div class="container">
        <div class="page-header_wrap">
          <div class="page-heading">
            <h1><?php echo htmlentities($result->PageName); ?></h1>
          </div>
          <ul class="coustom-breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li><?php echo htmlentities($result->PageName); ?></li>
          </ul>
        </div>
      </div>
      <!-- Dark Overlay-->
      <div class="dark-overlay"></div>
    </section>
    <!-- /Banners --> 
    <!-- Body-->
    <section class="section-padding gray-bg">
      <div class="container">
        <div class="section-header text-center">
          <h2>Checkout the <span>Companies</span></h2>
          <!-- <p></p> -->
        </div>
        <div class="row"> 
          <!-- Nav tabs -->
          <div class="recent-tab">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#" role="tab" data-toggle="tab"></a></li>
            </ul>
          </div>
          <!-- BlueChips -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="bluechips">
              <?php 
              $sql = "SELECT tblcompany.VehiclesTitle,tblcategories.BrandName,tblcompany.PricePerDay,tblcompany.FuelType,tblcompany.ModelYear,tblcompany.id,tblcompany.SeatingCapacity,tblcompany.VehiclesOverview,tblcompany.Vimage1 from tblcompany join tblcategories on tblcategories.id=tblcompany.VehiclesBrand";
              $query = $dbh -> prepare($sql);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              $cnt=1;

              if($query->rowCount() > 0)
              {
                foreach($results as $result)
                { ?>  
                  <div class="col-list-3">
                    <div class="recent-car-list">
                      <div class="car-info-box"> <a href="stock-purchase.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>
                        <ul>
                          <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> Model</li>
                        </ul>
                      </div>
                      <div class="car-title-m">
                        <h6><a href="stock-purchase.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                        <span class="price">$<?php echo htmlentities($result->PricePerDay);?> /Day</span> 
                      </div>
                      <div class="inventory_info_m">
                        <p><?php echo substr($result->VehiclesOverview,0,70);?></p>
                      </div>
                    </div>
                  </div>
                <?php 
                }
              } ?>       
            </div>
          </div>
        </div>
      </section>
    <!-- /BlueChips --> 

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
    <script type="text/javascript" src="assets/js/script.js"></script>

  </body>
</html>