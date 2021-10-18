<?php include('partials/menu.php'); ?>

    <!-- Main Content Section -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>

            <?php
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Enter the title"></td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td><input type="number" name="price"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
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
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        
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
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <br><br>

            <?php
                if(isset($_POST['submit'])){
                    // Get Data from the form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    
                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }
                    else{
                        $featured = "No";
                    }

                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }
                    else{
                        $active = "No";
                    }

                    // Upload the image if selected
                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];

                        if($image_name != ""){
                            // Rename the image
                            // Get the extension of selected image
                            $ext = end(explode('.',$image_name));
                            $image_name = "food-name-".rand(000,999).".".$ext;
                            // Get the source and destination path
                            $src = $_FILES['image']['tmp_name'];
                            $dest = "../images/food/".$image_name;

                            // Finally upload the image
                            $upload = move_uploaded_file($src,$dest);

                            // Check whether image uploaded or not
                            if($upload == false){
                                $_SESSION['upload']="<div class='error'>Failed to upload image. </div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                                die();
                            }
                        }
                    }
                    else{
                        $image_name = "";
                    }

                    // Insert the data into database

                    $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2 == true){
                        $_SESSION['add']="<div class='success'>Food added successfully </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else{
                        $_SESSION['add']="<div class='error'>Failed to Add food. </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>