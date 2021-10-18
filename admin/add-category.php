<?php include('partials/menu.php'); ?>

    <!-- Main Contents Starts Here -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <br><br>

            <!-- Add category forms starts -->

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Category title"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <!-- Add category forms ends -->

            <?php
                // Check the submit button is clicked or not

                if(isset($_POST['submit'])){
                    // Get Value from form
                    $title = $_POST['title'];
                    // For radio input type we need to check whether the button is selected or not
                    if(isset($_POST['featured'])){
                        // Get the value from form
                        $featured = $_POST['featured'];
                    }
                    else{
                        // Set the default value
                        $featured = "No";
                    }
                    if(isset($_POST['active'])){
                        // Get the value from form
                        $active = $_POST['active'];
                    }
                    else{
                        // Set the default value
                        $active = "No";
                    }

                    // Check whether image is selected or not
                    // print_r($_FILES['image']);

                    // die(); // break the code here
                    if(isset($_FILES['image']['name'])){
                        // to upload a image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];

                        // upload image only if image is selected
                        if($image_name != ""){

                            //  Auto Renaming the image
                            // get the Extension of our image 
                            $ext = end(explode('.',$image_name));
                            $image_name = "food_category_".rand(000,999).'.'.$ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;
                            // Finally upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            // Check whether the image is uploaded or not
                            // And if the image is not uploaded then we will stop and redirect with error message
                            if($upload==false){
                                $_SESSION['upload']="<div class='error'> Failed to upload image</div>";
                                header('location:'.SITEURL.'admin/add-category.php');
                                // stop the process
                                die();
                            }
                        }
                    }
                    else{
                        // Don't upload image and set the image name value as blank
                        $image_name = "";
                    }

                    // sql for inserting data in database
                    $sql = "INSERT INTO tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                    ";

                    $res = mysqli_query($conn,$sql);

                    // check whether the query executed succesfully or not
                    if($res==true){
                        $_SESSION['add'] = "<div class='success'> Category added succsessfully. </div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else{
                        $_SESSION['add'] = "<div class='error'> Failed to add Category </div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                    }
                }
            ?>


        </div>
    </div>

    <!-- Main Contents Ends Here -->

<?php include('partials/footer.php'); ?>
