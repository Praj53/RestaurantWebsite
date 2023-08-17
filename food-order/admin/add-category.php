<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>

                </tr>
            </table>


        </form>
        <?php

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            // for radio input type we need to check whethe button is selectet or not
            if (isset($_POST['featured'])) {
                // get the value from form
                $featured = $_POST['featured'];
            } else {
                // set the default value
                $featured = "NO";
            }


            if (isset($_POST['active'])) {
                // get the value from form
                $active = $_POST['active'];
            } else {
                // set the default value
                $active = "No";
            }

            // print_r($_FILES['image']);
            // die();  break the code here
            if (isset($_FILES['image']['name'])) {
                $img_name = $_FILES['image']['name'];
                //upload the image only if image is selected
                if ($img_name != "") {
                    //auto raname our img
                    //to get the extension of our image (jpg,png,gif etc ) e.g specialfood.jpg
                    //it gives extension only like jpg
                    $ext = end(explode('.', $img_name));

                    //rename the image
                    $img_name = "Food_category_" . rand(000, 999) . '.' . $ext; //Food_category_.456.jpg
        
                    //upload the image
                    // to upload image we need image_name ,source path,destinaton path
        
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $img_name;

                    //finally upload the message
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whethe image is uploaded or not 
                    //and if the image is not uloaded then we will stop the process and redirect with error msg
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                        header('location:' . SITEURL . 'admin/add-category.php');
                        //stop the process beacause if we failed to upload the image we dont want to add data in database
                        die();
                    }
                }
            } else {
                $img_name = "";
            }
            //create sql query to insert category into database
            $sql = " INSERT INTO tbl_category  SET
            title='$title',
            image_name='$img_name',
            featured = '$featured',
            active = '$active'
            ";

            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>Category Added Sucessfully  </div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed To Add Category</div>";
                header('location:' . SITEURL . 'admin/add-category.php');

            }
        }

        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>