<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br><br>

            <?php
                // Get the Id of selected Admin
                $id = $_GET['id'];

                // Create SQL for same
                $sql = "SELECT * FROM tbl_admin WHERE id=$id";

                $res = mysqli_query($conn,$sql);

                if($res==true){
                    // Check whether there is data or not
                    $count = mysqli_num_rows($res);

                    // Check whether we have admin data or not
                    if($count==1){
                        // Get the details
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
                    }
                    else{
                        // redirect to manage-admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>

    <?php
        // Check whether the submit button is clicked or not
        if(isset($_POST['submit'])){
            // Get all the values from form
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            // Create SQL Query to update Admin
            $sql = "UPDATE tbl_admin SET 
                full_name = '$full_name',
                username = '$username' 
                WHERE id='$id'
            ";

            // Execute the Query
            $res = mysqli_query($conn,$sql);

            // Check whether the query executed successfully or not
            if($res==true){
                $_SESSION['update'] ="<div class='success'>Admin Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else{
                $_SESSION['update'] ="<div class='error'>Failed to Update Admin</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            
        }

    ?>
    <!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?> 