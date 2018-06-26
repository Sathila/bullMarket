<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{	
    if(isset($_POST['submit'])){
      
      $ModelYear=$_POST['ModelYear'];
      $id=$_POST['id'];

      $select = "SELECT ModelYear from tblcompany where id=:id";
      $query_select = $dbh -> prepare($select);
      $query_select -> bindParam(':id',$id,PDO::PARAM_STR);
      $query_select ->execute();
      $results=$query_select->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query_select->rowCount() > 0) {
        foreach($results as $result) {
          $stocks = $result->ModelYear;
        }
      }  

      $stocks_left = $stocks - $ModelYear;

      $sql="update tblcompany set ModelYear=:ModelYear where id=:id ";
      $query = $dbh->prepare($sql);
      $query->bindParam(':ModelYear',$stocks_left,PDO::PARAM_STR);
      $query->bindParam(':id',$id,PDO::PARAM_STR);
      $query->execute();
      
      $sql_purchase="update tblpurchases set stocks='0' where id=:id ";
      $query_purchase = $dbh->prepare($sql_purchase);
      $query_purchase->bindParam(':id',$id,PDO::PARAM_STR);
      $query_purchase->execute();

      $msg="Data updated successfully";
      
    }
 ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>BULL MARKET - My Stocks</title>
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

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  
</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>My Stocks</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>My Stocks</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">
          <?php }}?>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
   
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">My Stocks </h5>
		  <form method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT tblcompany.Vimage1 as Vimage1,tblcompany.VehiclesTitle,tblcompany.id as vid,tblcategories.BrandName,tblpurchases.FromDate,
tblpurchases.ToDate,tblpurchases.stocks,tblpurchases.Status from tblpurchases join tblcompany on tblpurchases.CompanyId=tblcompany.id 
join tblcategories on tblcategories.id=tblcompany.VehiclesBrand where tblpurchases.userEmail=:useremail";
$query = $dbh -> prepare($sql);
$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<li>

		<input type="hidden" name="id" id="id" value="<?php echo htmlentities($result->vid); ?>">
                <div class="vehicle_img"> <a href="stock-purchase.php?vhid=<?php echo htmlentities($result->vid);?>""><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                <div class="vehicle_title">
                  <h6><a href="stock-purchase.php?vhid=<?php echo htmlentities($result->vid);?>""> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                  <p><b>From Date:</b> <?php echo htmlentities($result->FromDate);?><br /> <b>To Date:</b> <?php echo htmlentities($result->ToDate);?></p>
                </div>
       <div style="float: left"><p><b>Stocks:</b> <?php echo htmlentities($result->stocks); ?> </p></div>
		<input type="hidden" name="ModelYear" id="ModelYear" value="<?php echo htmlentities($result->stocks); ?>">
              </li>
              <?php }} ?>
             
         <div class="vehicle_status"> <button class="btn btn-primary" name="submit" type="submit">Sell Stocks</button>
            <div class="clearfix"></div>
        </div>
            </ul>
          </div>
		  </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

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
<?php } ?>