<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];  // Dispalying session message
                    unset($_SESSION['add']); // Unset the session
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];  // Dispalying session message
                    unset($_SESSION['delete']); // Unset the session
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];  // Dispalying session message
                    unset($_SESSION['update']); // Unset the session
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];  // Dispalying session message
                    unset($_SESSION['user-not-found']); // Unset the session
                }
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];  // Dispalying session message
                    unset($_SESSION['pwd-not-match']); // Unset the session
                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];  // Dispalying session message
                    unset($_SESSION['change-pwd']); // Unset the session
                }
            ?>

            <br><br><br>

            <!-- Button to add admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.No.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    // Query to get data from database
                    $sql = "SELECT * FROM tbl_admin";

                    $res = mysqli_query($conn,$sql);

                    // Check whether the Query is executed or not
                    if($res==true){
                        // Count rows to check is there is admin or not
                        $count = mysqli_num_rows($res); // Function to get all the rows in the database
                        $sn = 1;

                        // Check the number of rows
                        if($count > 0){
                            // mysqli_fetch_assoc($res) get data of row and store in $rows variable
                            while($rows=mysqli_fetch_assoc($res)){
                                // Get Individual data
                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                // Dispaly the value in table
                                ?>
                                    <tr>
                                        <td><?php echo $sn; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class=btn-primary>Change Password</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class=btn-secondary>Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class=btn-danger>Delete Admin</a>
                                        </td>
                                    </tr>

                                <?php
                                $sn = $sn + 1;

                            }
                        }
                        else{

                        }
                    }
                ?>

            </table>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>    
