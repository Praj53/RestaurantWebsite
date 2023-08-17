<?php include('partials-front/menu.php'); ?>
<?php
//check whether food id is set or not
//if not set then order.php file will not be open
if (isset($_GET['food_id'])) {
    //get the food id and details of selected food
    $food_id=$_GET['food_id'];

    //get the details of selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id ";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count ==1) {
        $row = mysqli_fetch_assoc($res);
            
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            
        
    }else{
        header('location:'.SITEURL);
    }
} else {
    //redirect
    header('location:'.SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center" style="color:white;">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend  class="text-order"  >Selected Food</legend>

                <div  class="food-menu-img">
                <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not Available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" alt="Momo" class="img-responsive img-curve" width="100px" height="100px">
                        <?php
                        }
                        ?>
                    <!-- <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve"> -->
                </div>

                <div class="food-menu-desc">
                    <h3 class="text-order" ><?php echo $title ;?></h3>
                    <input  class="text-order" type="hidden" name="food" value="<?php  echo $title;?>">
                    <p class="food-price text-order"  >₹<?php echo $price ;?></p>
                    <input class="text-order"  type="hidden" name="price" value="<?php  echo $price;?>">
                    <div class="order-label text-order"  >Quantity</div>
                    <input   type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend class="text-order" >Delivery Details</legend>
                <div class="text-order"  class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. xyz" class="input-responsive" autocomplete="off" required>

                <div  class="text-order" class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" autocomplete="off">

                <div class="text-order"  class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. xyz@.com" class="input-responsive" autocomplete="off" required>

                <div class="text-order"  class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" autocomplete="off" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        <?php 
        //check whether submbit btn is clik ornot
        if(isset($_POST['submit']))
        {
         $food = $_POST['food'];
         $price = $_POST['price'];
         $qty = $_POST['qty'];
         $total = $price * $qty;
         $order_date = date("Y-m-d h:i:sa");//order dATE
         $status = "ordered";//ordered,deleiverd,cancled
         $customer_name=$_POST['full-name'];
         $customer_contact=$_POST['contact'];
         $customer_email = $_POST['email'];
         $customer_address = $_POST['address'];

         //save the data in db
         $sql2="INSERT INTO tbl_order SET
         food='$food',
         price=$price,
         qty=$qty,
         total=$total,
         order_date='$order_date',
         status='$status',
         customer_name='$customer_name',
         customer_contact='$customer_contact',
         customer_email='$customer_email',
         customer_address='$customer_address'
         ";
        //  echo $sql2; die();
         $res2=mysqli_query($conn,$sql2);
         if($res2==true)
         {
             //executued and order saved
             $_SESSION['order']="<div class='success text-center' style='font-size:20px;'>Food Ordered Successfully</div>";
             header('location:'.SITEURL);
         }else
         { $_SESSION['order']="<div class='error text-center'>Failed To Order Food</div>";
            header('location:'.SITEURL);

         }

        }
        ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>