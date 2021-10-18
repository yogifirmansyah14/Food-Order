<?php include('../config/constants.php'); ?>

<html>
    <head> 
        <title>Login - Food Order Sysytem </title>
        <link rel="stylesheet" href="../css/admin1.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];  // Dispalying session message
                    unset($_SESSION['login']); // Unset the session
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];  // Dispalying session message
                    unset($_SESSION['no-login-message']); // Unset the session
                }
            ?>
            <br><br>

            <!-- Login form starts Here -->

            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter password"><br><br>
                
                <input type="submit" name="submit" value="login" class="btn-primary">
                <br><br>
            </form>

            <!-- Login form ends Here -->
            <p class="text-center">Created by <a href="#">Kelompok 11</a></p>
        </div>
    </body>
</html>

<?php

    // Check that submit button is clicked or not
    if(isset($_POST['submit'])){
        // Get the username and password from the form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Check user with this password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // Execute the query
        $res = mysqli_query($conn,$sql);

        if($res==true){
            $count = mysqli_num_rows($res);
            if($count==1){
                // User exists
                $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
                $_SESSION['user'] = '$username'; // to check whether the user is loged in or not and logout will unset it
                // redirect to Home page
                header('location:'.SITEURL.'admin/');
            }
            else{
                // User doesnot exists
                $_SESSION['login'] = "<div class='error text-center'>Username and password didn't match.</div>";
                // redirect to Home page
                header('location:'.SITEURL.'admin/login.php');
            }
        }

    }
?>


