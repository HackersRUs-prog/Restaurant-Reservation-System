<?php
$host = "127.0.0.1";
$user = "root"; //edit if you have set a username for MySQL
$pass = ""; // edit if you have set a password
$name = "restaurant_management";

// Create connection syntax
$conn = new mysqli($host, $user, $pass, $name);
// Check connection
if($conn == TRUE){
// 	echo "Connection succesful";
}

else if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>