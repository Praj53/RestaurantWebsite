<?php include('partials/menu.php'); ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    $res2 = mysqli_query($conn, $sql2);


    $row2 = mysqli_fetch_assoc($res2);
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
}

?>

<div class="main-content">

    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <!-- //to be able upload the file -->
            <table class="tbl-3-">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"> <?php echo $description; ?>"</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>">
                    </td>
                </tr>

                <tr>

                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image == "") {

                            echo "<div class='error'> Image Not Added </div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px" heigth="50px">
                        <?php
                        }
                        ?>
                    </td>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //query to get active categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    //    echo"<option value='$category_id'>$category_title </option>";
                            ?>
                                    <option <?php if ($current_category == "category_id") {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                echo "<option  value='0'> Category not Available </option>";
                            }
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                }
                                ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                }
                                ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked"; //html property this put mark on radio selected
                                }
                                ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                }
                                ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update-Food" class="btn-secondary">
                    </td>

                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // echo"clicked";
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];
            //upload new img if uploaded
            //check whether image is selected or not
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    //upload the new image
                    //auto raname our img
                    //to get the extension of our image (jpg,png,gif etc ) e.g specialfood.jpg
                    //it gives extension only like jpg
                    $ext = end(explode('.', $image_name));

                    //rename the image
                    $image_name = "Food_Name_" . rand(000, 999) . '.' . $ext; //Food_category_.456.jpg

                    //upload the image
                    // to upload image we need image_name ,source path,destinaton path

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/Food/" . $image_name;

                    //finally upload the message
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whethe image is uploaded or not 
                    //and if the image is not uloaded then we will stop the process and redirect with error msg
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed To Upload Image</div>";
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        //stop the process beacause if we failed to upload the image we dont want to add data in database
                        die();
                    }
                    // B.removee the currenr img if available
                    if ($current_image != "") {
                        $path = "../images/Food/" . $current_image;
                        $remove = unlink($path);

                        //check whether remove or not
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed To Remove Current Image</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;//default image when image is not selectted
                }
            } else {
                $image_name = $current_image;//default image if btn is not clicked
            }



            //query to update database
            $sql3 = "UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured = '$featured',
            active = '$active'
            WHERE id=$id
            ";
            $res3 = mysqli_query($conn, $sql3);
            if ($res == true) {
                $_SESSION['update'] = "<div class='success'>Food Updated Sucessfully </div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['update'] = "<div class='success'> Failed To Update Food</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }
        }

        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>