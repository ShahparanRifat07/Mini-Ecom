<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/admin.php");


if (isset($_SESSION['LOGGEDIN']) && isset($_SESSION['USERID'])) {

    $id = $_SESSION["USERID"];
    $first_name = "";
    $last_name = "";
    $email = "";
    $is_admin = false;
    $profile_pic = "";


    $db1 = new Database();
    $con = $db1->connect_db();
    $query = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $is_admin = $row['is_admin'];
        $profile_pic = $row['profile_pic'];
        $is_loggedin = $row['is_loggedin'];
    }
}


?>


<style>
  .card {
    padding: 15px;
  }

  #profile-head {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    /* border: 1px solid red; */
    background: #E0E0E0;
    margin: 10px 2px;
    border-radius: 5px;
  }

  #profile-head>p {
    margin: 0;
    padding: 0;
  }

  #profile-head>p:nth-of-type(1) {
    padding-top: 10px;
  }

  #profile-head>p:nth-of-type(2) {
    font-size: 10px;
    color: #616161;
    padding-bottom: 10px;
  }

  .dropdown hr {
    margin: 0;
    padding: 0;
  }
</style>



<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a href="admin_dashboard.php" class="navbar-brand mt-2 mt-lg-0" href="#">
            <img src="images/Mini.svg" alt="" height="50px" width="120px">
                <!-- <img src="img/logo.svg" height="15" alt="MDB Logo" loading="lazy" /> -->
                <h3>Administrator</h3>
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="add_product.php"> <i class="fa-solid fa-bag-shopping"></i> Add Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_category.php"><i class="fa-solid fa-box"></i> Add Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Messages.php"><i class="fa-solid fa-envelope"></i> Messages <span class="text-warning">(8)</span></a>
                </li>
            </ul>
            <!-- Left links -->

        </div>

        <div class="d-flex align-items-center">




            <?php
            if (isset($_SESSION['LOGGEDIN'])) {
            ?>
                <a class="text-reset me-3" href="index.php">
                    Switch to User Account
                </a>


                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $profile_pic ?>" class="rounded-circle" height="40" width="45" alt="Profile Pic" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="user_account.php">My Account</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="admin_products.php">Products</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Categories</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="profile.php?user_id=<?php echo $id ?>">Messages</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="applied_jobs.php">Reviews</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="purchase_history.php">Purchase history</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="signout.php">Logout</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else {
            ?>

                <a href="login.php" role="button" class="btn btn-light btn-sm m-1" data-mdb-ripple-color="dark">Log In</a>
                <a href="signup.php" role="button" class="btn btn-dark btn-sm">Sign Up</a>
            <?php
            }
            ?>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->