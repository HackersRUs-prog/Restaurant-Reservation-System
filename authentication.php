<?php
require_once "dbconnection.inc.php";

session_start();

if(isset($_POST['login'])){

    $id = $_POST['email'];
    $password = $_POST['password'];
    $module = $_POST['mod'];  
    $a = "0";
    $s = "1";
    $c = "2";

    if ($module == $a){
         $sql1 = "SELECT * FROM `tbl_users` WHERE `email`='$id'";

        $query1 = mysqli_query($conn,$sql1);

        if(mysqli_num_rows($query1) > 0){
            $row = mysqli_fetch_assoc($query1);
            $pass = $row['password'];

if(md5($password) == $pass){

                $_SESSION['adminname'] = $row['user_id'];
                $_SESSION['Email'] = $row['email'];
                echo "Login Succesful.";
                header("Location: index1.php");
            }else{
                echo "Incorrect Password.
                <br>
                <p>Click <a href='index.php'>HERE</a> to Try Again.</p>";
            }
        }else{
            echo "Administrator does not exist.";
        }
} else  if ($module == $s){
         $sql1 = "SELECT * FROM `tbl_users` WHERE `email`='$id'";

        $query1 = mysqli_query($conn,$sql1);

        if(mysqli_num_rows($query1) > 0){
            $row = mysqli_fetch_assoc($query1);
            $pass = $row['password'];

if(md5($password) == $pass){

                $_SESSION['servername'] = $row['user_id'];
                $_SESSION['Email1'] = $row['email'];
                echo "Login Succesful.";
                header("Location: index2.php");
            }else{
                echo "Incorrect Password.
                <br>
                <p>Click <a href='index.php'>HERE</a> to Try Again.</p>";
            }
        }else{
            echo "Server does not exist.";
        }
} else  if ($module == $c){
         $sql1 = "SELECT * FROM `tbl_users` WHERE `email`='$id'";

        $query1 = mysqli_query($conn,$sql1);

        if(mysqli_num_rows($query1) > 0){
            $row = mysqli_fetch_assoc($query1);
            $pass = $row['password'];

if(md5($password) == $pass){

                $_SESSION['clientname'] = $row['user_id'];
                $_SESSION['Email2'] = $row['email'];
                echo "Login Succesful.";
                header("Location: index3.php");
            }else{
                echo "Incorrect Password.
                <br>
                <p>Click <a href='index.php'>HERE</a> to Try Again.</p>";
            }
        }else{
            echo "Client does not exist.";
        }
} else{
    echo "An error occured.";
}
}else{
    echo "Module  error occured.";
}

           
?>
