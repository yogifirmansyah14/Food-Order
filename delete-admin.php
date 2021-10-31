<?php

    // include constants.php here
    include('../config/constants.php');

    // Get the id of the admin to be deleted
    $id = $_GET['id'];

    // Create SQL Query to delete admin
    $sql ="DELETE FROM tbl_admin WHERE id=$id";

    // Execute query
    $res = mysqli_query($conn,$sql);

    // Check wheather the query executed successfully or not
    if($res==true){
        // Create session variable to Display message
        $_SESSION['delete'] = "<div class='success'> Admin Deleted successfully. </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    // Redirect to the manage-admin page with message

?>