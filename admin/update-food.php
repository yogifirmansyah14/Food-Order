<?php include('partials/menu.php'); ?>

<?php 

    // Check whether the id is set or not
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        $res2 = mysqli_query($conn,$sql2);
        // get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        // get the individual value of selected food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else{
        header('loacation:'.SITEURL.'admin/manage-food.php');
    }

?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <br><br>
            

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                    </tr>
                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php
                                if($current_image == ""){
                                    echo "<div class='error'> Image Not Available </div>";
                                }
                                else{
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="90px">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Select New Image</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category">
                            
                            <?php
                                // Create php code to display categories from database
                                // 1. Create sql to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // Executing query
                                $res = mysqli_query($conn, $sql);

                                // Count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                // if count is greater than zero, we have categories else we do not have categories
                                if ($count>0){
                                    // we have categories
                                    while($row=mysqli_fetch_assoc($res)){
                                        // get the details of category
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        

                                        ?>

                                        <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        
                                        <?php
                                    }
                                } else {
                                    // we do not have categories
                                    ?>

                                    <option value="0">Category not found</option>
                                    
                                    <?php
                                    
                                }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input <?php if($featured=="Yes"){echo "checked"; } ?> type="radio" name="featured" value="Yes">Yes
                            <input <?php if($featured=="No"){echo "checked"; } ?> type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked"; } ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked"; } ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td colsapn=2>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                error_reporting(0);
                if(isset($_POST['submit'])){
                    // Get all data from form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    // Upload the image if selected
                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];
                        // Check whether the file is available or not
                        if($image_name != ""){
                            $tmp = explode('.',$image_name);
                            $ext = end($tmp);
                            $image_name = "food-name-".rand(0000,9999).'.'.$ext;

                            // get the source path and destination path
                            $src_path = $_FILES['image']['tmp_name'];
                            $dest_path = "../images/food/".$image_name;

                            // Upload the image
                            $upload = move_uploaded_file($src_path,$dest_path);

                            // check for image is uploaded or not
                            if($upload == false){
                                $_SESSION['upload'] = "<div class='error'> Failed to upload new image. </div>";
                                header('loaction:'.SITEURL.'admin/manage_food.php');
                                die();
                            }
                            
                            // Remove the image if new image is uploaded and current image exists

                            if($current_image != ""){
                                $remove_path = "../images/food/".$current_image;
                                $remove = unlink($remove_path);

                                // Check for image is removed or not
                                if($remove == false){
                                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image. </div>";
                                    header('location:'.SITEURL.'admin/manage_food.php');
                                    die();
                                }
                            }
                        }
                        else{
                            $image_name = $current_image;
                        }
                    }
                    else{
                        $image_name = $current_image;
                    }    

                    // Update the food in database
                    $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                    ";

                    $res3 = mysqli_query($conn,$sql3);

                    // Check whether the query is executed or not
                    if($res3 == true){
                        $_SESSION['update'] = "<div class='success'>Food updated successfully. </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else{
                        $_SESSION['update'] = "<div class='error'>Failed to update food. </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }

                    echo "<br><br>";
                    echo "Updated successfully.. Please refresh or go to manage admin page. ";

                }
            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>