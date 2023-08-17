<?php 
include('../config/constants.php');
//check whether id and image are set ot not
if(isset($_GET['id']) AND isset($_GET['img_name']))
{
    //get the value and delete
    $id= $_GET['id'];
    $img_name = $_GET['img_name'];

    //remove img file is available
    if($img_name!=""){
        $path="../images/category/".$img_name;
        //remove the img
        $remove= unlink($path);
        //if fail to remove img
        if($remove==false){
           //set the session and redirect
           $_SESSION['remove']="<div class='error'> Failed to remove category Image</div>";
           header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    $sql="DELETE FROM tbl_category WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $_SESSION['delete']="<div class='sucess'>Category Delete Successfully </div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    else
    {
        $_SESSION['remove']="<div class='error'> Failed to Delete category </div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }
}
else{
    //redirect to manage category page
   header('location:'.SITEURL.'admin/manage-category.php');
}
?>