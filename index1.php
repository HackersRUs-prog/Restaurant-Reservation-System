<?php
require_once 'dbconnection.inc.php';
  session_start();

if (!isset($_SESSION['Email']) && !isset($_SESSION['adminname'])) {
    header("Location: index_home.php");
}else{
  $email = $_SESSION['Email'];
  $query1=mysqli_query($conn,"SELECT * FROM `tbl_users` WHERE `email`='$email'")or die(mysqli_error());
  $row=mysqli_fetch_array($query1);
  $filter = $_SESSION['adminname']; 
}

$query=mysqli_query($conn,"SELECT * FROM `tbl_restaurant` WHERE `Restaurant_ID`='1'")or die(mysqli_error());
$row5=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fine Dining - Administrator Homepage</title>
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
    align-items: center;
  }

   th, tr, td{
    padding: 10px;
  }
    </style>

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

            <script type="text/javascript">
function printData1()
{
   var divToPrint=document.getElementById("printTable1");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

            <script type="text/javascript">
function printData2()
{
   var divToPrint=document.getElementById("printTable2");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

            <script type="text/javascript">
function printData3()
{
   var divToPrint=document.getElementById("printTable3");
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
                    <a href="index1.php" class="navbar-brand">
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
        <a href="index1.php" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white"><i class="fs-1 text-primary me-3"></i><?php echo $row5['Name']; ?></h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-lg-auto py-0">
                <a href="index1.php" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About Us</a>
                <a href="#database" class="nav-item nav-link">Database</a>
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

    <!-- About Start -->
    <div id="about" class="container-fluid pt-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">About Us</h2>
                <h1 class="display-4 text-uppercase">Welcome Administrator, <?php echo $row['fullname']; ?></h1>
            </div>
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/<?php echo $row['image']; ?>" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pb-5">
                    <h4 class="mb-4">At Fine Dining, we understand that exceptional food deserves exceptional service.</h4>
                    <p class="mb-5"><?php echo $row5['About_Us']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Products Start -->
    <div id="database" class="container-fluid about py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Menu & Prices</h2>
            </div>
            <div class="tab-class text-center">
                <div class="tab-content">
                    <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">ID </th>
  <th style="text-align: left;
  padding: 8px;">Name </th>
<th style="text-align: left;
  padding: 8px;">Category </th>
  <th style="text-align: left;
  padding: 8px;">Buying Price (in .kshs) </th>
    <th style="text-align: left;
  padding: 8px;">Selling Price (in .kshs) </th>
    <th style="text-align: left;
  padding: 8px;">Created On </th>
    <th style="text-align: left;
  padding: 8px;">Updated On </th>
  <th style="text-align: left;
  padding: 8px;">Quantity </th>
  <th style="text-align: left;
  padding: 8px;">Image </th>
<th style="text-align: left;
  padding: 8px;"> </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_management");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `food_id`,`food_name`, `food_image`, `created_on`, `updated_on`, `food_category`, `food_buyingprice`, `food_sellingprice`, `admin_id`, `quantity` FROM `tbl_food`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["food_id"]); ?></td>
<td><?php echo($row["food_name"]); ?></td>
<td><?php echo($row["food_category"]); ?></td>
<td><?php echo($row["food_buyingprice"]); ?></td>
<td><?php echo($row["food_sellingprice"]); ?></td>
<td><?php echo($row["created_on"]); ?></td>
<td><?php echo($row["updated_on"]); ?></td>
<td><?php echo($row["quantity"]); ?></td>
<td><img src="img/<?php echo($row["food_image"]); ?>" style="width: 200px;"></td>
<td><button onclick="return confirm('Are you sure to delete this item?')?window.location.href='insertion.inc.php?action=deleteI&id=<?php echo ($row['food_id']); ?>':true;" title='Delete Item'>Delete</button></td>
</tr>
<?php
}
} else { echo "0 results."; }
$conn->close();
?>

</table>
<br>
<div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="" onclick="printData();" class="btn btn-primary border-inner py-3 px-5 me-5">Print</a>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Users</h2>
            </div>
            <div class="tab-class text-center">
                    <div class="tab-content">
                    <table id="printTable1">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">User ID </th>
<th style="text-align: left;
  padding: 8px;">Fullname </th>
  <th style="text-align: left;
  padding: 8px;">Email Address </th>
  <th style="text-align: left;
  padding: 8px;">Phone Number </th>
  <th style="text-align: left;
  padding: 8px;">Role </th>
  <th style="text-align: left;
  padding: 8px;">Image </th>
  <th style="text-align: left;
  padding: 8px;"> </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_management");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `user_id`, `fullname`, `email`, `phone_number`, `image`, `role` FROM `tbl_users`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["user_id"]); ?></td>
<td><?php echo($row["fullname"]); ?></td>
<td><?php echo($row["email"]); ?></td>
<td><?php echo($row["phone_number"]); ?></td>
<td><?php echo($row["role"]); ?></td>
<td><img src="img/<?php echo($row["image"]); ?>" style="width: 200px;"></td>
<td><button onclick="return confirm('Are you sure to delete this user?')?window.location.href='insertion.inc.php?action=deleteU&id=<?php echo ($row['user_id']); ?>':true;" title='Delete User'>Delete</button></td>
</tr>
<?php
} 
}else { echo "0 results."; }
$conn->close();
?>

</table>
<br>
<div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="" onclick="printData1();" class="btn btn-primary border-inner py-3 px-5 me-5">Print</a>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Restaurant Details</h2>
            </div>
            <div class="tab-class text-center">
                    <div class="tab-content">
                    <table id="printTable2">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Restaurant ID </th>
<th style="text-align: left;
  padding: 8px;">Name </th>
  <th style="text-align: left;
  padding: 8px;">About Us </th>
  <th style="text-align: left;
  padding: 8px;">Location </th>
  <th style="text-align: left;
  padding: 8px;">Phone Number </th>
  <th style="text-align: left;
  padding: 8px;">Email Address </th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "restaurant_management");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `Restaurant_ID`, `Name`, `About_Us`, `Location`, `Phone_Number`, `Email_Address` FROM `tbl_restaurant`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["Restaurant_ID"]); ?></td>
<td><?php echo($row["Name"]); ?></td>
<td><?php echo($row["About_Us"]); ?></td>
<td><?php echo($row["Location"]); ?></td>
<td><?php echo($row["Phone_Number"]); ?></td>
<td><?php echo($row["Email_Address"]); ?></td>
</tr>
<?php
} 
}else { echo "0 results."; }
$conn->close();
?>

</table>
<br>
<div class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5">
                        <a href="" onclick="printData2();" class="btn btn-primary border-inner py-3 px-5 me-5">Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

  <!-- Contact Start -->
    <div id="start" class="container-fluid contact position-relative px-5" style="margin-top: 90px;">
        <div class="container">
                        <div class="row g-5 mb-5">
                <div class="col-lg-6 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="fs-1 text-white"></i>
                        <span>Add Menu Item</span>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="fs-1 text-white"></i>
                        <span>Modify Menu Item</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="insertion.inc.php" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" name="iname" class="form-control bg-light border-0 px-4" placeholder="Item Name" style="height: 55px;" required>
                                <input type="hidden" name="aid" value="<?php echo $filter; ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="icat" class="form-control bg-light border-0 px-4" placeholder="Item Category" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" name="isp" class="form-control bg-light border-0 px-4" placeholder="Item Selling Price" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" name="ibp" class="form-control bg-light border-0 px-4" placeholder="Item Buying Price" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="quan" class="form-control bg-light border-0 px-4" placeholder="Item Quantity" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                              <label>Profile Picture : </label>
                                <input type="file" type="file" required name="image" value="" accept=".jpg, .jpeg, .png" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit" name="addf">Add </button>
                            </div>
                        </div>
                    </form>
                </div>
            <div class="col-lg-6">
                    <form action="insertion.inc.php" method="POST" enctype="multipart/form-data"> 
                        <div class="row g-3">
                        <div class="col-sm-6">
                                <select name="iid" required class="form-control bg-light border-0 px-4" style="height: 55px;">
                                  <option selected disabled value="0">Select A Food ID</option>
                                     <?php
                                      $con = mysqli_connect("localhost","root","","restaurant_management");
                                      $sql = "SELECT * FROM `tbl_food`";
                                      $all_categories = mysqli_query($con,$sql);
                                      while ($category = mysqli_fetch_array(
                                              $all_categories,MYSQLI_ASSOC)):;
                                  ?>
                                  <option value="<?php echo $category["food_id"];?>"><?php echo $category["food_id"];?></option>
                                  <?php
                                      endwhile;
                                  ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="iname" class="form-control bg-light border-0 px-4" placeholder="Item Name" style="height: 55px;" required>
                                <input type="hidden" name="aid" value="<?php echo $filter; ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="password" class="form-control bg-light border-0 px-4" placeholder="Item Category" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="icat" class="form-control bg-light border-0 px-4" placeholder="Item Category" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" name="isp" class="form-control bg-light border-0 px-4" placeholder="Item Selling Price" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" name="ibp" class="form-control bg-light border-0 px-4" placeholder="Item Buying Price" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="quan" class="form-control bg-light border-0 px-4" placeholder="Item Quantity" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                              <label>Profile Picture : </label>
                                <input type="file" type="file" required name="image" value="" accept=".jpg, .jpeg, .png" style="height: 55px;" required>
                            </div> 
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit" name="upf">Update </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <!-- Contact End -->

      <!-- Contact Start -->
    <div id="" class="container-fluid contact position-relative px-5" style="margin-top: 90px;">
        <div class="container">

                        <div class="row g-5 mb-5">
                                           <div class="col-lg-6 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="fs-1 text-white"></i>
                        <span>Add A Server</span>
                    </div>
                </div>
                 <div class="col-lg-6 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="fs-1 text-white"></i>
                        <span>Update Restaurant Details</span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                            <div class="col-lg-6">
                    <form action="insertion.inc.php" method="POST" enctype="multipart/form-data"> 
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" name="fname" class="form-control bg-light border-0 px-4" placeholder="Your Name" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Your Email" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="phone" class="form-control bg-light border-0 px-4" placeholder="Your Phone Number" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Profile Picture : </label>
                                <input type="file" type="file" required name="image" value="" accept=".jpg, .jpeg, .png" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-12">
                                <input type="password" name="password" class="form-control bg-light border-0 px-4" placeholder="Your Password" style="height: 55px;" required>
                            </div>
                           <div class="col-sm-12">
                                <input type="password" name="cpassword" class="form-control bg-light border-0 px-4" placeholder="Confirm Your Password" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit" name="adds">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <form action="insertion.inc.php" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" name="rname" class="form-control bg-light border-0 px-4" placeholder="Restaurant Name" style="height: 55px;" value="<?php echo $row5['Name']; ?>" required>
                                <input type="hidden" name="aid" value="<?php echo $filter; ?>" required>
                            </div>

                            <div class="col-sm-6">
                                <input type="text" name="rloc" value="<?php echo $row5['Location']; ?>" class="form-control bg-light border-0 px-4" placeholder="Location " style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">      
                                <input type="text" name="rphone" value="<?php echo $row5['Phone_Number']; ?>" class="form-control bg-light border-0 px-4" placeholder="Phone Number " style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="remail" value="<?php echo $row5['Email_Address']; ?>" class="form-control bg-light border-0 px-4" placeholder="Email Address" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-12">
                                <textarea class="form-control bg-light border-0 px-4 py-3" value="" rows="4" name="rabout" placeholder="About Us" required><?php echo $row5['About_Us']; ?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit" name="upr">Update </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <!-- Contact End -->
    

    <!-- Footer Start -->
    <div id="contact" class="container-fluid bg-img text-secondary" style="margin-top: 90px">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 col-md-6 mb-lg-n5">
                    <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4">
                        <a href="index1.php" class="navbar-brand">
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
                                <p class="mb-0">Nairobi, KENYA.</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">fine.dining@gmail.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">+254 794 345934</p>
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
                                <a class="text-secondary mb-2" href="index1.php"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
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