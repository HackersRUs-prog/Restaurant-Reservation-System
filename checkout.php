<?php 
require_once 'dbconnection.inc.php';
session_start();

// Include the configuration file 
require_once 'config.php'; 

// Initialize shopping cart class 
include_once 'cart.class.php'; 
$cart = new Cart; 

if (!isset($_SESSION['Email2']) && !isset($_SESSION['clientname'])) {
    header("Location: index_home.php");
}else{
  $email = $_SESSION['Email2'];
  $query=mysqli_query($conn,"SELECT * FROM `tbl_users` WHERE `email`='$email'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}
// If the cart is empty, redirect to the products page 
if($cart->total_items() <= 0){ 
    header("Location: index3.php"); 
} 
 
// Get posted form data from session 
$postData = !empty($_SESSION['postData'])?$_SESSION['postData']:array(); 
unset($_SESSION['postData']); 
 
// Get status message from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
} 
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

      <!-- Contact Start -->
    <div class="container-fluid contact position-relative px-5" style="margin-top: 90px;">
        <div class="container">
                        <div class="row g-5 mb-5">
                <div class="col-lg-12 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="fs-1 text-white"></i>
                        <span>My Orders</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                  <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                </div>
                <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                </div>
                <?php } ?>
                
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">My Orders</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $cart->total_items(); ?></span>
                    </h4>
                    <ul class="list-group mb-12">
                    <?php 
                    if($cart->total_items() > 0){ 
                        // Get cart items from session 
                        $cartItems = $cart->contents(); 
                        foreach($cartItems as $item){ 
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                                <small class="text-muted"><?php echo CURRENCY_SYMBOL.$item["price"]; ?>(<?php echo $item["qty"]; ?>)</small>
                            </div>
                            <span class="text-muted"><?php echo CURRENCY_SYMBOL.$item["subtotal"]; ?></span>
                        </li>
                    <?php } } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (<?php echo CURRENCY; ?>)</span>
                            <strong><?php echo CURRENCY_SYMBOL.$cart->total(); ?></strong>
                        </li>
                    </ul>
                    <a href="index3.php" class="btn btn-sm btn-info">+ add items</a>
                </div>
                <div class="col-md-12 order-md-1">
                <div class="row g-5 mb-5">
                <div class="col-lg-12 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="fs-1 text-white"></i>
                        <span>My Checkout Details</span>
                    </div>
                </div>
            </div>
                    <div class="contact-form">
                      <div class="col-lg-12">
                    <form method="post" action="cartaction.php">
                      <div class="row g-3">
                            <div class="col-sm-4">
                                <label>Time of Reservation : </label>
                                <input type="time" name="time" class="form-control bg-light border-0 px-4" style="height: 55px;" required>
                                <input type="hidden" name="cid" value="<?php echo $_SESSION['clientname']; ?>" required>
                                <input type="hidden" name="status" value="Pending" required>
                            </div>
                            <div class="col-sm-4">
                                <label>Date of Reservation : </label>
                                <input type="date" name="date" class="form-control bg-light border-0 px-4" min="<?= date('Y-m-d'); ?>" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-4">
                                <label>P.S : M-PESA is the current payment method.</label>
                               <select name="method" required class="form-control bg-light border-0 px-4" style="height: 55px;">
                                  <option selected disabled value="0">Select A Payment Method</option>
                                  <option value="M-PESA (with a Standard Fee of 150 kshs.)">M-PESA (with a Standard Fee of 150 kshs.)</option>
                                </select>
                                
                            </div>
                            <div class="col-sm-12">
                                <label>Details of Reservation : </label>
                                <textarea class="form-control bg-light border-0 px-4 py-3" name="details" rows="4" name="rabout" placeholder="Any details and extra information that you would like us to know ?" required></textarea>
                            </div>
                            <div class="col-sm-12">       
                        <input type="hidden" name="action" value="placeOrder"/>
                        <button class="btn btn-primary border-inner w-100 py-3" type="submit" name="checkoutSubmit">Place Order</button>
                      </div>
                      </div>
                    </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- Contact End -->
    

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