<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div>
        <h1 class="text-center">Manage Order</h1>
        <br><br>
        <?php if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];   //Displaying session msg
            unset($_SESSION['update']); //removing session msg
        }
        ?>
        <br><br>
        <table class="tbl-full-order">
            <tr>
                <th>Sr. No</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Cust_Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT *FROM tbl_order ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
            ?>
                    <tr>
                        <td class="contento"><?php echo $sn++; ?></td>
                        <td class="contento"><?php echo $food; ?></td>
                        <td class="contento">₹<?php echo $price; ?></td>
                        <td class="contento"><?php echo $qty; ?></td>
                        <td class="contento"><?php echo $total; ?></td>
                        <td class="contento"><?php echo $order_date; ?></td>

                        <td class="contento"> 
                            <?php 
                            if($status=="ordered"){
                                echo"<label style='color:black;'> $status </label>";
                            }
                            elseif($status=="On Delivery"){
                                echo "<label style='color:orange;'>$status</label> ";
                            }
                             elseif($status=="Delivered"){
                                echo "<label style='color:green;'>$status</label> ";
                            }
                            elseif($status=="Cancelled"){
                                echo "<label style='color:red;'>$status</label> ";
                            }
                            ?>
                        </td>

                        <td class="contento"><?php echo $customer_name; ?></td>
                        <td class="contento"><?php echo $customer_contact; ?></td>
                        <td class="contento"><?php echo $customer_email; ?></td>
                        <td class="contento"><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                            <!-- <a href="#" class="btn-danger">Delete Admin</a> -->
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr> <td colspan='12' class='error'>Orders Not Available</td> </tr> ";
            }
            ?>



        </table>
    </div>

</div>
<?php include('partials/footer.php'); ?>