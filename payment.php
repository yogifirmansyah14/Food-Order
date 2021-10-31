<?php include('partials-front/menu.php'); ?>
    
    <?php
        // get customer_name from url
        $customer_name = $_GET["order_name"];
        
        $sql = "SELECT * FROM tbl_order WHERE customer_name='$customer_name'";

        $res = mysqli_query($conn, $sql);

        $payment = mysqli_fetch_assoc($res);
    ?>
 <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm payment your order.</h2>

            <?php
                if(isset($_SESSION['order'])){
                    echo $_SESSION['order'];
                    unset ($_SESSION['order']);
                }
            ?>
                <fieldset>
                    <div><b>Please transfer payment for procces</b></div>
                    <br>
                    <p>A.N Moch Yogi Firmansyah (20051397044) / BRI</p>
                </fieldset>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="text-center"><strong>Payment Total $. <?php echo $payment["total"]; ?></strong></div>
                    <div class="order-label">Name</div>
                    <input type="text" name="name" placeholder="Enter Name" class="input-responsive" required>

                    <div class="order-label">Bank</div>
                    <input type="text" name="bank" placeholder="Enter Bank Name" class="input-responsive" required>

                    <div class="order-label">Total</div>
                    <input type="text" name="total" placeholder="Enter Payment (1.00)" class="input-responsive" required>

                    <div class="order-label">Payment Proof</div>
                    <input type="file" name="proof" class="input-responsive" required>

                    <button class="btn btn-primary" name="submit">Submit</button>
                </form>


                <?php
                    // if isset submit button
                    if (isset($_POST["submit"])) {
                        // upload image payment proof
                        if(isset($_FILES['proof']['name'])){
                            // to upload a image we need image name, source path and destination path
                            $image_name = $_FILES['proof']['name'];
    
                            // upload image only if image is selected
                            if($image_name != ""){
    
                                //  Auto Renaming the image
                                // get the Extension of our image 
                                $ext = end(explode('.',$image_name));
                                $image_name = "proof_".rand(000,999).'.'.$ext;
    
                                $source_path = $_FILES['proof']['tmp_name'];
    
                                $destination_path = "images/proof/".$image_name;
                                // Finally upload the image
                                $upload = move_uploaded_file($source_path,$destination_path);
    
                                // Check whether the image is uploaded or not
                                // And if the image is not uploaded then we will stop and redirect with error message
                                if($upload==false){
                                    $_SESSION['upload']="<div class='error'> Failed to upload image</div>";
                                    header('location:'.SITEURL.'payment.php');
                                    // stop the process
                                    die();
                                }
                            }
                        }
                        
                        $name = $_POST['name'];
                        $bank = $_POST['bank'];
                        $total = $_POST['total'];
                        $date = date("Y-m-d");

                        $sql = "INSERT INTO tbl_payment SET
                        customer_name = '$customer_name',
                        name = '$name',
                        bank = '$bank',
                        total = '$total',
                        date = '$date',
                        proof = '$image_name'
                        ";

                        // Execute the query
                        $res = mysqli_query($conn, $sql);

                        // check whether query executed succesfully or not
                        if($res==true) {
                            // query executed and order saved
                            $_SESSION['order'] = "<div class='success text-center'>Food ordered succesfully</div>";
                            header('location:'.SITEURL);
                        } else {
                            // Failed to save order
                            $_SESSION['order'] = "<div class='error text-center'>Failed to order food</div>";
                            header('location:'.SITEURL);
                        }
                    }
                ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>