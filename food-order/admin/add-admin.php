<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br><br>
        <?php
        if(isset($_SESSION['add']))  //checking the session is set or not
        {
             echo $_SESSION['add'];   //Displaying session msg
             unset($_SESSION['add']); //removing session msg
        } 
      
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name " autocomplete="off"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="pass" placeholder="Your Password" autocomplete="off">
                    </td>
                </tr> 
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php 
//1. Process the value from form and save it in database
// check whether submit button is clicked or not
if(isset($_POST['submit']))
{

    $full_name =$_POST['full_name'];
    $username =$_POST['username'];
    $password =md5($_POST['pass']);

//2.SQL query to save the data into databse
   $sql ="INSERT INTO tbl_admin SET 
   full_name='$full_name',
   username='$username',
   password='$password'
   ";
   
//3.Executing query and saving data into database
   $res = mysqli_query($conn,$sql) or die(mysqli_error());

//check whether data is inserted or not and display appropriate message
   if($res ==TRUE){
// create a session variable to display msg
   $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
// redirect page to manage-admin
   header("location:".SITEURL.'admin/manage-admin.php');

    }
    else
    {
        // create a session variable to display msg 
        $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
        // redirect page to manage-admin
         header("location:".SITEURL.'admin/add-admin.php');
    }
}
  
?>