<?php 

session_start();
session_destroy();

header("Location: index_home.php");

?>