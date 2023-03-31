<?php 

date_default_timezone_set('Africa/Nairobi');

//ADMINISTRATOR SECTION
//Add Servers
if (isset($_POST['adds'])) {
 $phone = $_POST['phone'];
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

  if ($password == $passwordconfirm) {

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'img';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql1 = "INSERT INTO `tbl_users`(`fullname`, `email`, `phone_number`, `image`, `password`, `role`) VALUES ('$fname','$email','$phone','$newImgName',md5('$password'),'Server')";
     mysqli_query($conn, $sql1);
   // var_dump($sql);
   // die();
  header("Location: index1.php?serverregistration=success");
 }
}
}else{
  echo "Passwords do not match.";
 }
}

//Add Food
if (isset($_POST['addf'])) {
 $iname = $_POST['iname'];
 $icat = $_POST['icat'];
 $bprice = $_POST['ibp'];
 $sprice = $_POST['isp'];
 $aid = $_POST['aid'];
 $quan = $_POST['quan'];

  require_once 'dbconnection.inc.php';

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'img';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql1 = "INSERT INTO `tbl_food`(`food_name`, `food_image`, `created_on`, `updated_on`, `food_category`, `food_buyingprice`, `food_sellingprice`, `admin_id`, `quantity`) VALUES ('$iname','$newImgName',NOW(),NOW(),'$icat','$bprice','$sprice','$aid','$quan')";

     mysqli_query($conn, $sql1);
   // var_dump($sql);
   // die();
  header("Location: index1.php?addmenuitem=success");
 }
}
}

//Edit Food
if (isset($_POST['upf'])) {
 $foname = $_POST['iname'];
 $fcat = $_POST['icat'];
 $bprice = $_POST['ibp'];
 $sprice = $_POST['isp'];
 $aid = $_POST['aid'];
 $fid = $_POST['iid'];
 $quan = $_POST['quan'];

  require_once 'dbconnection.inc.php';

   $sql = "SELECT * FROM `tbl_food` WHERE `food_id`='$fid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'img';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql = "UPDATE `tbl_food` SET `food_name` = '$foname' , `food_image` = '$newImgName' , `updated_on` = NOW(), `food_category` = '$fcat' , `food_buyingprice` = '$bprice' , `food_sellingprice` = '$sprice' , `admin_id` = '$aid' , `quantity` = '$quan' WHERE `food_id` = '$fid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?updatemenuitem=success");
 }
}
}else{
  echo "Food ID does not exist, kindly try again with an existing Food ID.
  <br>
  <p> Click <a href='index1.php'>HERE</a> to Try Again.";
}
}

//Edit Restaurant
if (isset($_POST['upr'])) {
 $rname = $_POST['rname'];
 $rloc = $_POST['rloc'];
 $rphone = $_POST['rphone'];
 $remail = $_POST['remail'];
 $rabout = $_POST['rabout'];
 $aid = $_POST['aid'];

  require_once 'dbconnection.inc.php';

   $sql = "SELECT * FROM `tbl_users` WHERE `user_id`='$aid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

   $sql = "UPDATE `tbl_restaurant` SET `Name`='$rname',`About_Us`='$rabout',`Location`='$rloc',`Phone_Number`='$rphone',`Email_Address`='$remail' WHERE `Restaurant_ID`= 1";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index1.php?updaterestaurant=success");
 }else{
  echo "Administrator ID does not exist, kindly try again with an existing Administrator ID.";
}
}

if($_REQUEST['action'] == 'deleteI' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `tbl_food` WHERE `food_id` = '$deleteItem'";
        mysqli_query($conn, $sql); 
        header("Location: index1.php?deletefood=success");
        }

if($_REQUEST['action'] == 'deleteU' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `tbl_users` WHERE `user_id` = '$deleteItem'";
        mysqli_query($conn, $sql); 
        header("Location: index1.php?deleteuser=success");
        }

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//SERVER Section
//Update Servers
if (isset($_POST['eds'])) {
 $uid = $_POST['uid'];
 $phone = $_POST['phone'];
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $password = $_POST['password'];

 require_once 'dbconnection.inc.php';

  $sql =  "SELECT * FROM `tbl_users` WHERE `user_id`='$uid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

   $sql = "UPDATE `tbl_users` SET `fullname` = '$fname' , `phone_number` = '$phone', `email` = '$email' , `password` = md5('$password') WHERE `user_id` = '$uid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index2.php?updateserver=success");
 }
}

if (isset($_POST['completeorder'])) {
        $sid = $_POST['sid'];
        $deleteItem = $_POST['oid']; 

        $state1 = 'Completed';
        $state2 = 'Cancelled';

        require_once 'dbconnection.inc.php';
        
        $sql =  "SELECT * FROM `tbl_order` WHERE `order_id`='$deleteItem'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
         $row = mysqli_fetch_assoc($query);
         $state = $row['order_status'];
        if ($state == $state1) {
          echo "<script>alert('Order has already been Completed!')</script>";
        }else if ($state == $state2) {
          echo "<script>alert('Order has already been Cancelled!')</script>";
        }
        else{
        $sql = "UPDATE `tbl_order` SET `order_status` = 'Completed', `server_id` = '$sid' WHERE `order_id` = '$deleteItem'";
        $sql2 = "UPDATE `tbl_reservations` SET `server_id` = '$sid' WHERE `order_id` = '$deleteItem'";
        mysqli_query($conn, $sql); 
        mysqli_query($conn, $sql2); 
        header("Location: index2.php?completeorder=success");
        }
        }else{
          echo "Order not found.";
        }
        }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//GUEST Section
//Update Guest
if (isset($_POST['upg'])) {
 $uid = $_POST['uid'];
 $phone = $_POST['phone'];
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $password = $_POST['password'];

 require_once 'dbconnection.inc.php';

  $sql =  "SELECT * FROM `tbl_users` WHERE `user_id`='$uid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

   $sql = "UPDATE `tbl_users` SET `fullname` = '$fname' , `phone_number` = '$phone', `email` = '$email' , `password` = md5('$password') WHERE `user_id` = '$uid'";

     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index3.php?updateguest=success");
 }
}

//Add Guests
if (isset($_POST['addg'])) {
 $phone = $_POST['phone'];
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

  if ($password == $passwordconfirm) {

     if ($_FILES["image"]["error"] === 4) {
   echo "<script> alert('Image does not exist!'); </script>";
}else{
  $uploads_dir = 'img';
  $fileName = $_FILES["image"]["name"];
  $fileSize = $_FILES["image"]["size"];
  $tmpName = $_FILES["image"]["tmp_name"];

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    echo "<script> alert('Invalid Image Format!'); </script>";
  }else if($fileSize > 10000000){
    echo "<script> alert('Image is too large!'); </script>";
  }else{

    $newImgName = uniqid();
    $newImgName .= '.' . $imageExtension;

    move_uploaded_file($tmpName, "$uploads_dir/$newImgName");

   $sql1 = "INSERT INTO `tbl_users`(`fullname`, `email`, `phone_number`, `image`, `password`, `role`) VALUES ('$fname','$email','$phone','$newImgName',md5('$password'),'Guest')";
     mysqli_query($conn, $sql1);
   // var_dump($sql);
   // die();
  header("Location: index_home.php?guestregistration=success");
 }
}
}else{
  echo "Passwords do not match.";
 }
}

if($_REQUEST['action'] == 'cancelO' && !empty($_REQUEST['id'])){ 
        $state1 = 'Cancelled';
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql =  "SELECT * FROM `tbl_order` WHERE `order_id`='$deleteItem'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
         $row = mysqli_fetch_assoc($query);
         $state = $row['order_status'];
        if ($state == $state1) {
          echo "<script>alert('Order has already been Cancelled!')</script>";
        }
        else{
        $sql = "UPDATE `tbl_order` SET `order_status` = 'Cancelled' WHERE `order_id` = '$deleteItem'";
        mysqli_query($conn, $sql); 
        header("Location: index3.php?cancelorder=success");
        }
        }
        }

 ?>