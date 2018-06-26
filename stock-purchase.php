<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit'])) {
  $fromdate=$_POST['fromdate'];
  $todate=$_POST['todate']; 
  $stocks=$_POST['num_of_stocks'];
  $useremail=$_SESSION['login'];  
  $status=0;
  $vhid=$_GET['vhid'];
  $sql="INSERT INTO  tblpurchases(userEmail,CompanyId,FromDate,ToDate,stocks,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:stocks,:status)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
  $query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
  $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
  $query->bindParam(':todate',$todate,PDO::PARAM_STR);
  $query->bindParam(':stocks',$stocks,PDO::PARAM_STR);
  $query->bindParam(':status',$status,PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId) {
    echo "<script>alert('Booking successfull.');</script>";
  }
  else {
    echo "<script>alert('Something went wrong. Please try again');</script>";
  }

} ?>

<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Car Rental Port | Vehicle Details</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  </head>
  <body>
    <!--Header-->
    <?php include('includes/header.php');?>
    <!-- /Header --> 

    <!--Listing-Image-Slider-->
    <?php 
    $vhid=intval($_GET['vhid']);
    $sql = "SELECT tblcompany.*,tblcategories.BrandName,tblcategories.id as bid  from tblcompany join tblcategories on tblcategories.id=tblcompany.VehiclesBrand where tblcompany.id=:vhid";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0) {
      foreach($results as $result) {  
        $_SESSION['brndid']=$result->bid; ?>

        <section id="listing_img_slider">
          <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="900" height="560"></div>
          <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image" width="900" height="560"></div>
          <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image" width="900" height="560"></div>
          <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive"  alt="image" width="900" height="560"></div>
          <?php 
          if($result->Vimage5=="") {

          } else { ?>
            <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image" width="900" height="560"></div>
          <?php } ?>
        </section>
        <!--/Listing-Image-Slider-->

        <!--Listing-detail-->
        <section class="listing-detail">
          <div class="container">
            <div class="listing_detail_head row">
              <div class="col-md-9">
                <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
              </div>
              <div class="col-md-3">
                <div class="price_info">
                  <p>$<?php echo htmlentities($result->PricePerDay);?> </p>Per Stock         
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-9">
                <div class="main_features">
                  <ul>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i>
                      <h5><?php echo htmlentities($result->ModelYear);?></h5>
                      <p>Available Stocks</p>
                    </li>
                    <!-- <li> 
                      <i class="fa fa-cogs" aria-hidden="true"></i>
                      <h5><?php //echo htmlentities($result->FuelType);?></h5>
                      <p>Fuel Type</p>
                    </li>       
                    <li> 
                      <i class="fa fa-user-plus" aria-hidden="true"></i>
                      <h5><?php //echo htmlentities($result->SeatingCapacity);?></h5>
                      <p>Seats</p>
                    </li> -->
                  </ul>
                </div>
                <div class="listing_more_info">
                  <div class="listing_detail_wrap"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs gray-bg" role="tablist">
                      <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
                      <!-- <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li> -->
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content"> 
                      <!-- vehicle-overview -->
                      <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                        <p><?php echo htmlentities($result->VehiclesOverview);?></p>
                      </div>
                      <!-- Accessories -->
                      <div role="tabpanel" class="tab-pane" id="accessories"> 
                       
                      </div>
                    </div>
                  </div>
                </div>
              <?php }
            } ?>   
          </div>
          
          <!--Side-Bar-->
          <aside class="col-md-3">      
            <!-- <div class="share_vehicle">
              <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
            </div> -->
            <div class="sidebar_widget">
              <div class="widget_heading">
                <h5><i class="fa fa-envelope" aria-hidden="true"></i>Buy Now</h5>
              </div>
              <form method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="num_of_stocks" id="num_of_stocks" onchange="num_stocks()" placeholder="Number of Stocks" required>
                </div>
                <div class="form-group">
                  <a class="btn" onclick="total_cost()">Calculate Price</a>
                </div>
                <div class="form-group">
                  <input type="text" id="total" name="total" class="form-control" id="finalprice" placeholder="">
                </div>
                <?php 
                if($_SESSION['login']) { ?>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Book Now" onclick()>
                  </div>
                <?php } else { ?>
                  <a href="#loginform" class="btn btn-primary" data-toggle="modal" data-dismiss="modal">Login For Book</a>
                <?php } ?>
              </form>
            </div>
          </aside>
          <!--/Side-Bar--> 
        </div>    
        <div class="space-20"></div>
        <div class="divider"></div>    
        <!--Similar-Cars-->
        <div class="similar_cars">
          <h3>Similar Cars</h3>
          <div class="row">
            <?php 
            $bid=$_SESSION['brndid'];
            $sql="SELECT tblcompany.VehiclesTitle,tblcategories.BrandName,tblcompany.PricePerDay,tblcompany.FuelType,tblcompany.ModelYear,tblcompany.id,tblcompany.SeatingCapacity,tblcompany.VehiclesOverview,tblcompany.Vimage1 from tblcompany join tblcategories on tblcategories.id=tblcompany.VehiclesBrand where tblcompany.VehiclesBrand=:bid";
            $query = $dbh -> prepare($sql);
            $query->bindParam(':bid',$bid, PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0) {
              foreach($results as $result) { ?>      
                <div class="col-md-3 grid_listing">
                  <div class="product-listing-m gray-bg">
                    <div class="product-listing-img"> <a href="stock-purchase.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" /> </a>
                    </div>
                    <div class="product-listing-content">
                      <h5><a href="stock-purchase.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
                      <p class="list-price">$<?php echo htmlentities($result->PricePerDay);?></p>          
                      <ul class="features_list">                
                        <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                        <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              <?php }
            } ?>
          </div>
        </div>
        <!--/Similar-Cars-->     
      </div>
    </section>
    <!--/Listing-detail--> 

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

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script> 
    <script src="assets/js/interface.js"></script> 
    <script src="assets/switcher/js/switcher.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script> 
    <script src="assets/js/slick.min.js"></script> 
    <script src="assets/js/owl.carousel.min.js"></script>
  </body>
</html>

<script>

var total = 0;

function num_stocks(){
  var stocks = document.getElementById("num_of_stocks").value;
  var stocks_ava = <?php echo $result->ModelYear; ?>;
  var price = <?php echo $result->PricePerDay; ?>; 
  
  if(stocks > stocks_ava){
    alert("Please enter a number less than or equal to available stocks.");
  }else{
    // alert(price);
    total = stocks * price;
  }
  document.getElementById("total").value = total;
}

function total_cost(){
  document.getElementById("total").value = total;
}

</script>