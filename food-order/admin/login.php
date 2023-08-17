<?php include('../config/constants.php') ?>
<html>
    <head>
        <title>
            LOGIN- Food Order System
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body Class="loginbg">

        <div class="login">
            
               <h1  class="text-center loginhead">Login</h1>
               <br>
               <?php
               if(isset($_SESSION['login']))
               {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
               }
               if(isset($_SESSION['no-login-msg']))
               {
                    echo $_SESSION['no-login-msg'];
                    unset ($_SESSION['no-login-msg']);
               }
               ?>
               <!-- login form starts here -->
               <br>
               <form action="" method="POST" class="text-center">
               <span class="logincr">Username:</span> 
                <input class="logininput" type="text" name="username" placeholder="Enter username" autocomplete="off">
                <br><br>
                 <span class="logincr">Password:</span>
                <input class="logininput" type="password" name="password" placeholder="Enter Password" >
                <br><br>
                <input class="loginbtn" type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
               </form>
               <!-- login form ends here -->
               <!-- <p class="text-center">Create by- <a href="" > Prajakta Ghanwat</a></p> -->
        </div>
       
    </body>
</html>
<?php 
   if(isset($_POST['submit']))
   {
    //Get data from login form
   $username =mysqli_real_escape_string($conn, $_POST['username']);
   $password =mysqli_real_escape_string($conn,md5($_POST['password']));

   $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
   $res = mysqli_query($conn,$sql);
   
   //count rows to check whether the user exists or not
   $count= mysqli_num_rows($res);
   if($count==1)
   {
       $_SESSION['login']= "<div class='success'> LOGIN SUCESSFULL </div>";
       $_SESSION['user']= $username;  //to check whether the user is login or not and  logout will unset it
       header('location:'.SITEURL.'admin/');
   }
   else
   {
    $_SESSION['login']= "<div class='error text-center' > Username and Password did not match </div>";
    header('location:'.SITEURL.'admin/login.php');
   }
}
?>