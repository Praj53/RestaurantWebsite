<?php include('partials/menu.php'); ?>

    <!-- Main Content Section starts here -->
   <div class="main-content">
       <div class="wrapper" >
        <h1>Manage Admin</h1>
        <br/> <br> 
        <?php
        if(isset($_SESSION['add']))
        {
             echo $_SESSION['add'];   //Displaying session msg
             unset($_SESSION['add']); //removing session msg
        } 
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];   //Displaying session msg
            unset($_SESSION['delete']);

        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];   //Displaying session msg
            unset($_SESSION['update']);

        }
        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];   //Displaying session msg
            unset($_SESSION['user-not-found']);

        }
        if(isset($_SESSION['pass-not-match']))
        {
            echo $_SESSION['pass-not-match'];   //Displaying session msg
            unset($_SESSION['pass-not-match']);

        }
        if(isset($_SESSION['change-pass']))
        {
            echo $_SESSION['change-pass'];   //Displaying session msg
            unset($_SESSION['change-pass']);

        }
        ?>
        <br> <br>
        <br>
         <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
           <br/>
           <br>
           <br>           
           <table class="tbl-full">
                <tr>
                    <th>Sr. No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            <?php 
                //Query to get all admin
                $sql = "SELECT * FROM tbl_admin";
                //Execute the query
                $res= mysqli_query($conn,$sql);
                // check whethe the query is executed or not
                if($res==TRUE)
                {
                    //Count the rows whether we have data in the databse or not
                    $count = mysqli_num_rows($res);

                    $sn=1; //crate for assign the values to id continuously though we delete any middle entry
                    //check the no of rows

                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            //using while loop to get all the data from databse
                            //and while loop will run as long as we have data in database

                            //get individual data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            //Display the values in our table
             ?>
                            
                               <tr>
                                

                                   <td class="content"><?php echo $sn++;       ?></td>
                                   <td class="content"><?php echo $full_name ?></td>
                                   <td class="content"><?php echo $username ?></td>
                                   <td>
                                    <a href="<?php echo SITEURL;?>admin/update-pass.php?>id=<?php echo $id; ?>" class="btn-primary">Update Password</a>
                                   <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                   <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger" >Delete Admin</a>
                                    </td>
                               </tr>
                            
                             <?php

                        }

                    }
                }
            ?>
            </table>
            
       </div>
   
   </div>
    <!-- Menu Section ends here -->

    <?php include('partials/footer.php'); ?>