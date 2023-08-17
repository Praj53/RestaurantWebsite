<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD FOOD</h1>
        <br><br>
        <?php 
        if(isset($_SESSION['$upload'])){
            echo $_SESSION['$upload'];
            unset($_SESSION['$upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title Of Food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="descriptiono of food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //create php code to display categories from database
                            //sql query to get all active catefgories form db
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            if ($res == true) {
                                echo "fine";
                            } else {
                                echo "Not fine";
                            }
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php

                            }
                            //display on dropsown

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" value="Yes" name="featured">Yes
                        <input type="radio" value="No" name="featured">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" value="Yes" name="active">Yes
                        <input type="radio" value="No" name="active">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        //check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            //get the dataa from form and insert into database
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check whether radio btn is clicked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active= $_POST['active'];
            } else {
                $active = "No";
            }

            // upload the image if selected
            if(isset($_FILES['image']['name'])){
                //get the detailes 
                $image_name=$_FILES['image']['name'];
                //check whether image is selected or not if selected then only upload
                if($image_name!="")//img is selected
                { 
                    //A. rename the img
                    // get the extension of selected img
                    $ext =end(explode('.',$image_name));
                     //create new image name
                     $image_name = "Food-Name".rand(000,999).".".$ext;
                    //B.upload the img
                    //get the source path and destination path
                    //source path is the current location 
                    $src = $_FILES['image']['tmp_name'];
                    //destination path
                    $des="../images/Food/".$image_name;
                    //finally upload img
                    $upload =move_uploaded_file($src,$des);
                    //check whether image uploaded or not
                    if($upload==false){
                        //failed to upload the img
                        $_SESSION['upload']="<div class='error'>Failed To Upload Image </div>";
                        //redirect to add food page with error msg
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();//stop the process
                    }

                }
            }
            else{
                $image_name="";//setting default value as blank
            }
            //3.Insert into database

            //create a sql query to save
            //for numerical value not need to pass value inside quotes
            $sql2="INSERT INTO tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id=$category,
            featured='$featured',
            active='$active'
            ";

            $res2=mysqli_query($conn,$sql2);
            //check whether data inserted or not
             //redirect with msg to manage food page
            if($res2==true){
                $_SESSION['add']="<div class='sucess'>Food Added Sucessfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                $_SESSION['add']="<div class='error'>Failed To Add Food</div>";
                header('location:'.SITEURL.'admin/manage-food.php'); 
            }
           
        
        }
        ?>

    </div>
</div>
<?php include('partials/footer.php'); ?>