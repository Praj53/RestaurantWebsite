<?php  
//include constants.php file here
include('../config/constants.php');
//1.get the id of admin to be deleted
 $id = $_GET['id'];
//2.Create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
//Execute the query
$res=mysqli_query($conn , $sql);
//check where query is sucesfully executes or not
if($res==true)
{
    //create session variable to display msg
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Sucessfully.</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
      //create session variable to display msg
      $_SESSION['delete'] = "<div class='error' >Failed to delete Admin . Try again later</div>";
      //Redirect to manage admin page
      header('location:'.SITEURL.'admin/manage-admin.php');
}
//3.Redirect to manage admin page with message (success/error)


?>