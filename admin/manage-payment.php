<?php include('partials/menu.php'); ?>
<!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Payment</h1>
            <br><br>
    
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Bank</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Proof</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_payment";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count > 0){
                        $sn = 1;

                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $name = $row['name'];
                            $bank = $row['bank'];
                            $total = $row['total'];
                            $date = $row['date'];
                            $proof_name = $row['proof'];
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $bank; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                        <?php 
                                            // Check image name is available or not
                                            if($proof_name!=""){
                                                // Display the image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/proof/<?php echo $proof_name; ?>" width="80px">
                                                <?php
                                            }
                                            else{
                                                // Display the message
                                                echo "<div class='error'> Image not added. </div>";
                                            }
                                        ?>
                                    </td>
                            </tr>
                        <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <!-- Main Content Section Ends -->
<?php include('partials/footer.php'); ?>