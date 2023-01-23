
<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>

            <br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];  // Dispalying session message
                    unset($_SESSION['login']); // Unset the session
                }
                // Categories Count
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);                
                // Categories Count
                $sql2 = "SELECT * FROM tbl_food";
                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);                
                // Orders Count
                $sql3 = "SELECT * FROM tbl_order";
                $res3 = mysqli_query($conn,$sql3);
                $count3 = mysqli_num_rows($res3);                               
            ?>
            <br><br>

            <div class="col-4 text-center">
                <h1><?= $count; ?></h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1><?= $count2; ?></h1>
                <br>
                Foods
            </div>

            <div class="col-4 text-center">
                <h1><?= $count3; ?></h1>
                <br>
                Orders
            </div>

            <div class="col-4 text-center">
                <h1>Payments</h1>
                <br>
                Categories
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>