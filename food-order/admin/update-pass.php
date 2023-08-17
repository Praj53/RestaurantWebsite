<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }


        ?>
        <form action=" " method="POST">
            <table class=" tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_pass" placeholder="Old Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="new_pass" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_pass" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>

                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?> ">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
//check whether the submit button is clicked or normalizer_get_raw_decomposition

if (isset($_POST['submit'])) {
    echo "btn";
    //echo cliked
    //get data from from
    $id = $_POST['id'];
    $current_pass = md5($_POST['current_pass']);
    $new_pass = md5($_POST['new_pass']);
    $confirm_pass = md5($_POST['confirm_pass']);

    //check whether user with current id and currrnt pass exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_pass'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        echo "res";
        $count = mysqli_num_rows($res);
        //check whether we have admin data or not
        if ($count == 1) {
            echo "user exists and can change password";
            if ($new_password == $confirm_pass) {
                $sql2 = "UPDATE tbl_admin SET
                        password='$new_pass'
                        WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['change-pass'] = "<div class='error'> Change Successfully. </div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');

                } else {
                    $_SESSION['change-pass'] = "<div class='error'>Failed to change password. </div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                $_SESSION['pass-not match'] = "<div class='error'> User not found. </div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');

            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'> User not found. </div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
    //check whether new passa and confirm pass match or not
    //
}
?>
<?php include('partials/footer.php'); ?>