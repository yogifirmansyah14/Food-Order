<?php
    include('../config/constants.php');

    // Destroy the session and 
    session_destroy(); // Unset $_SESSION['user]

    // Redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>