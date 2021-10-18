<?php

    include('../config/constants.php');
    // Check whether id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // Get the value 
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the physical image from folder 
        if($image_name != ""){
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove == false){
                // Image not removed
                $_SESSION['remove'] = "<div class='error'> Failed to remove Category image </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        // Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true){
            $_SESSION['delete'] = "<div class='success'> Category deleted successfully. </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'> Failed to remove Category. </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        // Redirect to manage category page
        
    }
    else{
        // Redirect to manage category page 
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>