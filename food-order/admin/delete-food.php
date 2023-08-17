<?php
 include('../config/constants.php');

 if(isset($_GET['id']) && isset($_GET['image_name']))
 {
    //get id and image name
    $id= $_GET['id'];
    $image_name=$_GET['image_name'];

    //remove image if available
    //check whether image id available or not and delete only if available
    if($image_name!=""){
        //it has image and need to remove from folder
        //get the image path
        $path="../images/food/".$image_name;
        //remove image file from folder
        $remove=unlink($path);
        //check whether image is removed or not
        if($remove==false){
            $_SESSION['upload']="<div class='error'>Failed To Remove Image File</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
        
    }
    //delete food from database
    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['delete']="<div class='success'>Food Deleted Successfully </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else{
        $_SESSION['delete']="<div class='error'>Failed To Delete Food </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    //redirect to manage food with session msg

 }else{
    $_SESSION['unauth']="<div class='error'>Unauthorized Acess </div>";
    header('location:'.SITEURL.'admin/manage-food.php');
 }
