<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Password</h1>
            <br><br>

            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password</td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>
                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php
        // Check whether the submit button is clicked or not

        if(isset($_POST['submit'])){
            // get the data from form
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            // check whether the user with curr password exists or not
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
            
            $res = mysqli_query($conn,$sql);

            if($res==true){
                // check whether data is available or not
                $count = mysqli_num_rows($res);
                if($count==1){
                    // User Exists and password can be changed
                    // check whether the new password and confirm password match or not

                    if($new_password == $confirm_password){
                        // change password if all above is true
                        $sql2 = "UPDATE tbl_admin SET 
                            password = '$new_password'
                            WHERE id=$id
                        ";

                        $res2 = mysqli_query($conn,$sql2);

                        if($res==true){
                            $_SESSION['change-pwd'] = "<div class='success'>Passowrd changed successfully</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else{
                            $_SESSION['change-pwd'] = "<div class='error'>Failed to change Password</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else{
                        $_SESSION['pwd-not-match'] = "<div class='error'>Passowrd doesn't Match</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else{
                    // User doesnot exists
                    $_SESSION['user-not-found'] = "<div class='error'>User not Found</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }

        }
    ?>

    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?> 