<?php
    // Check for user is logged in or not
    // Authorization 

    if(!isset($_SESSION['user'])){
        // If Login is not set means user is not logged in
        // redirect to login page with message
        $_SESSION['no-login-message']="<div class='error text-center'> Please login to excess admin panel. </div>";
        header('location:'.SITEURL.'admin/login.php');
    }
    
?>