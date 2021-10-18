<?php

    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // Process to delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the image is available
        if($image_name != ""){
            $path = "../images/food/".$image_name;

            $remove = unlink($path);
            if($remove == false){
                $_SESSION['upload'] = "<div class='error'> Failed to remove image. </div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete'] = "<div class='success'> Food Deleted successfully. </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'> Failed to Delete Food. </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        
    }
    else{
        // Redirect to manage food page
        $_SESSION['delete'] = "<div class='error'> Unauthorized Access. </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>