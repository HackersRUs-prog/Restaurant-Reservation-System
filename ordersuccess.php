<?php 
require_once 'dbconnection.inc.php';
session_start();
if(empty($_REQUEST['id'])){ 
    header("Location: index3.php"); 
} 
$order_id = base64_decode($_REQUEST['id']); 
 
// Fetch order details from the database 
$sqlQ = "SELECT `order_id`, `customer_id`, `server_id`, `created_on`, `order_total`, `order_status` FROM `tbl_order` WHERE `order_id` = ?";
$stmt = $conn->prepare($sqlQ); 
$stmt->bind_param("i", $db_id); 
$db_id = $order_id; 
$stmt->execute(); 
$result = $stmt->get_result(); 
 
if($result->num_rows > 0){ 
    $orderInfo = $result->fetch_assoc(); 
}else{ 
    header("Location: index3.php"); 
}

if (!isset($_SESSION['Email2']) && !isset($_SESSION['clientname'])) {
    header("Location: index_home.php");
}else{
  $email = $_SESSION['Email2'];
  $query=mysqli_query($conn,"SELECT * FROM `tbl_users` WHERE `email`='$email'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}

// Include the configuration file 
require_once 'config.php'; 

$query=mysqli_query($conn,"SELECT * FROM `tbl_restaurant` WHERE `Restaurant_ID`='1'")or die(mysqli_error());
$row5=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fine Dining - Place Order Page</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

    <style type="text/css">
        
          table{
    border: solid 1px black;
    align-items: center;
  }

   th, tr, td{
    border: solid 1px black;
    padding: 0px 0px;
  }
    </style>

     <script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>

            <script type="text/javascript">
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid px-0 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Email Us</h6>
                        <span><?php echo $row5['Email_Address']; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-primary border-inner py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <a href="index3.php" class="navbar-brand">
                        <h1 class="m-0 text-uppercase text-white"><i class="fs-1 text-dark me-3"></i><?php echo $row5['Name']; ?></h1>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center bg-secondary py-3">
                <div class="d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                    <div class="text-start">
                        <h6 class="text-uppercase mb-1">Call Us</h6>
                        <span><?php echo $row5['Phone_Number']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index3.php" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white"><i class="fs-1 text-primary me-3"></i><?php echo $row5['Name']; ?></h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-lg-auto py-0">
                <a href="index3.php" class="nav-item nav-link active">Home</a>
                <a href="index3.php" class="nav-item nav-link">About Us</a>
                <a href="logout.php" class="nav-item nav-link">Logout </a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-start">
                <div class="col-lg-8 text-center text-lg-start">
                    <h1 class="display-1 text-uppercase text-white mb-4"><?php echo $row5['Name']; ?></h1>
                    <h1 class="text-uppercase text-white">The Finest Restaurant in Nairobi</h1>
                    <div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="#about" class="btn btn-primary border-inner py-3 px-5 me-5">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Products Start -->
    <div class="container-fluid about py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Order Success!</h2>
            </div>
            <div class="tab-class text-center">
                <div class="tab-content" id="printTable">
                       <?php if(!empty($orderInfo)){ ?>
            <div class="col-md-12">
                <div class="alert alert-success">Your order has been placed successfully.</div>
            </div>
            
            <!-- Order status & shipping info -->
            <div id="receipt" class="row col-lg-12 ord-addr-info">
                <div class="hdr">Order Info:
                <br>
                <p><b>Customer ID:</b> #<?php echo $orderInfo['customer_id']; ?>
                <br>
                <b>Total:</b> <?php echo CURRENCY_SYMBOL.$orderInfo['order_total'].' '.CURRENCY; ?>
                <br>
                <b>Order Placed On:</b> <?php echo $orderInfo['created_on']; ?>
                <br>
                <b>Server ID:</b> <?php echo $orderInfo['server_id']; ?>
                <br>
                <b>Order ID:</b> <?php echo $orderInfo['order_id']; ?>
                <br>
                <b>Order Status:</b> <?php echo $orderInfo['order_status']; ?></p>
                <br>
                </div>
            </div>
            
               <br>
                                   <br>
                                   <div class="col-md-12 col-sm-12">
                            <button class="btn btn-primary border-inner py-3 px-5 me-5" id="cf-submit" onclick="printData()">Print Receipt</button>
                                   </div>
                                   <br>
                                   <br>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="index3.php" class="btn btn-primary border-inner py-3 px-5 me-5"><i class="ialeft"></i>Make Another Order </a>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
        <div class="col-md-12">
            <div class="alert alert-danger">Your order submission failed!</div>
        </div>
        <?php } ?>    
            </div>
            <br>
            <br>
        </div>
    </div>
  </div>
    <!-- Products End -->
    

    <!-- Footer Start -->
    <div class="container-fluid bg-img text-secondary" style="margin-top: 90px">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 mb-lg-n5">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4">
                        <a href="index3.php" class="navbar-brand">
                            <h1 class="m-0 text-uppercase text-white"><i class="fs-1 text-dark me-3"></i>Fine Dining</h1>
                        </a>
                        <p class="mt-3">Our team of passionate chefs, led by our Executive Chef, takes great pride in crafting innovative and flavorful dishes that showcase the best of local and seasonal ingredients. We believe that every dish should be a work of art that excites the senses and leaves a lasting impression on our guests.</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0"><?php echo $row5['Location']; ?>.</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0"><?php echo $row5['Email_Address']; ?></p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0"><?php echo $row5['Phone_Number']; ?></p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-primary text-uppercase mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-secondary mb-2" href="index3.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-secondary mb-2" href="#about"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                                <a class="text-secondary mb-2" href="#menu"><i class="bi bi-arrow-right text-primary me-2"></i>Menu & Prices</a>
                                <a class="text-secondary" href="#contact"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-secondary py-4" style="background: #111111;">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">Fine Dining</a>. All Rights Reserved.</p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>