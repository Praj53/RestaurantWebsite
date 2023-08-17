<?php 
//Authorization: acess control
//check whether user is login or not
if(!isset($_SESSION['user']))//if user session is not set
{

      $_SESSION['no-login-msg']= "<div class='error text-center'> Please login to access admin panel. </div>";
      header('location:'.SITEURL.'admin/login.php');
}
       
?>