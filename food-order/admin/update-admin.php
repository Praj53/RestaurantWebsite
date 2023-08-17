<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
              //1.Get the id of selected admin
              $id=$_GET['id'];
             //2.create the sql query to update the details
              $sql="SELECT * FROM tbl_admin WHERE  id=$id";
             //3. Execute the query
             $res=mysqli_query($conn,$sql);

             //check whether query is executed or not
             if($res==true){
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count==1){
                    // echo"Admin Is Available";
                    $row=mysqli_fetch_assoc($res);
                    $full_name=$row['full_name'];
                    $username = $row['username'];
                }
                else{
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
             }
        ?>
        <form action=" " method="POST">
            <table class=" tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td> 
                        <input type=" text" name = "full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr> 
                <tr>
                    <td>UserName</td>
                    <td>
                        <input type="text" name="user_name" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" >
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
 <?php
 if(isset($_POST['submit'])){
    // echo"Button Clicked";
    // Get values from the form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['user_name'];

    //create a sql query to update admin
    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
      //Query executed and admin updates
      $_SESSION['update']="Admin updates succesfully";
      header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
         $_SESSION['update']="Failed to updated successfully";
         header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
 ?>
  <?php include('partials/footer.php'); ?>