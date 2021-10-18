<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];  // Dispalying session message
                    unset($_SESSION['add']); // Unset the session
                }
            ?>

            <br><br>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter your Name">
                        </td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter your User Name">
                        </td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Enter your Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- Main Content Section Ends -->


<?php include('partials/footer.php'); ?>  

<?php
    // Process the value from form and save it in database

    // Check the submit button is clicked or not
    if(isset($_POST['submit'])){
        // Button clicked
        
        // get the data from the form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); // Password Encryption with MD5

        // SQL query to save the data into the database

        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        // Executing the Query and saving data in database
        $res = mysqli_query($conn,$sql) or die(mysqli_error());

        // Check whether the data is inserted or not and display appropriate
        if($res==true){
            // data inserted
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
            // redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            // data not inserted
            // Create a session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
            // redirect page to manage admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }

?>
