<?php include('partials/menu.php'); ?>


        <!-- Main Content Section Stars -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>

                <br /><br />

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }
                ?>
                <br><br><br>

                <!-- Button to Add Admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>


                    <?php 
                        //Query to Get all Admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Check whether the Query is Executed of Not
                        if($res==TRUE)
                        {
                            // Count Rows to Check Whether we have data in database or not
                            $count = mysqli_num_rows($res); // Function to get all the rows in database

                            $sn=1; //Create a Variable and Assign the value

                            //CHeck the num of rows
                            if($count>0)
                            {
                                //We Have data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //Using While loop to get all the data from database.
                                    //And while loop will run as long as we have data in database

                                    //Get individual Data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display The Values in our Table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                        <a href="a" class="btn-secondary">Update Admin</a>
                                        <a href="a" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php

                                }
                            }
                            else
                            {
                                //We Do not Have Data in Database
                            }
                        }

                    ?>


                    <tr>
                        <td>1. </td>
                        <td>Amalia Ramadhani</td>
                        <td>amaliaramadhani</td>
                        <td>
                           <a href="a" class="btn-secondary">Update Admin</a>
                           <a href="a" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2. </td>
                        <td>Yogi Firmansyah</td>
                        <td>yogifirmansyah</td>
                        <td>
                            <a href="a" class="btn-secondary">Update Admin</a>
                            <a href="a" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3. </td>
                        <td>Nurma Sari</td>
                        <td>nurmasari</td>
                        <td>
                            <a href="a" class="btn-secondary">Update Admin</a>
                            <a href="a" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                </table>

            </div>
        </div>   
        <!-- Main Content Setion Ends -->
        
<?php include('partials/footer.php'); ?>


