<?php
require_once("models/database.php");
require_once("models/user.php");
require_once("models/category.php");

if (isset($_SESSION['LOGGEDIN']) && isset($_SESSION['USERID'])) {
  $db1 = new Database();
  $con = $db1->connect_db();

  $id = $_SESSION["USERID"];
  $first_name = "";
  $last_name = "";
  $email = "";
  $is_admin = false;
  $profile_pic = "";

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
      <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
        <!-- <img src="img/logo.svg" height="15" alt="MDB Logo" loading="lazy" /> -->
        <img src="images/Mini.svg" alt="" height="50px" width="120px">
      </a>


      <!-- Left links -->
      <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Categories</a>
                </li>
            </ul> -->
      <!-- Left links -->



      <ul class="navbar-nav">
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">



            <?php
            $cat = new Category();
            $cat_result = $cat->getAllCategories();
            if ($cat_result->num_rows > 0) {
              while ($row = $cat_result->fetch_assoc()) {

            ?>
                <li>
                  <a class="dropdown-item" href="product_category.php?category_id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a>
                </li>
              <?php
              }
            } else {
              ?>
              <li>
                <a href=""></a>
              </li>
            <?php
            }
            ?>
          </ul>
        </li>
      </ul>
      <div class="col-md-8 ms-3">
        <form method="GET" action="search.php" class="d-flex input-group w-auto my-auto ">
          <input name="search" autocomplete="off" type="search" class="form-control rounded" placeholder="Search" aria-describedby="search-addon" />
          <button type=submit class="input-group-text border-0" id="search-addon">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>
    </div>
    <!-- Collapsible wrapper -->



    <!-- <form class="d-flex input-group w-80 w-auto ">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"></i>
            </span>
        </form> -->

    <!-- Right elements -->



    <div class="d-flex align-items-center">
      <!-- Icon -->





      <?php
      if (isset($_SESSION['LOGGEDIN'])) {
      ?>
        <?php
        if ($is_admin == true) {
        ?>
          <a class="text-reset me-3" href="admin_dashboard.php">
            <span><i class="fa-solid fa-user"></i></span>
            Admin Dashboard
          </a>
        <?php
        }
        ?>

        <!-- Avatar -->
        <div class="dropdown">
          <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo $profile_pic ?>" class="rounded-circle" height="40" width="45" alt="Profile Pic" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">

            <li>
              <div id="profile-head">
                <p><strong><?php echo $first_name . " " . $last_name ?></strong></p>
                <p><span><?php echo $email ?></p>
              </div>
            </li>
            <li>
              <a class="dropdown-item" href="user_account.php">My Account</a>
            </li>
            <li>
              <a class="dropdown-item" href="my_orders.php">My Orders</a>
            </li>
            <hr>
            <li>
              <a class="dropdown-item" href="user_wishlist.php">My Wishlist</a>
            </li>
            <hr>
            <li>
              <a class="dropdown-item" href="user_review.php">My Review</a>
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

        <a href="signin.php" role="button" class="btn btn-light btn-sm m-1" data-mdb-ripple-color="dark">Log In</a>
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