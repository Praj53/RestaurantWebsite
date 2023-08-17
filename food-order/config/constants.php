<?php 
// start session
session_start();

// Create constants to store non repeting values
define("SITEURL",'http://localhost/food-order/');
define('LOCALHOST','localhost:3307');
define('DB_USERNAME','root');
define('DB_PASS','');
define('DB_NAME','food-order');
$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASS) or die(mysqli_error()); 
$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
?>