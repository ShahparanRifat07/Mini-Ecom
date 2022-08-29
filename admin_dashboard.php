<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/admin.php");
require_once("models/product.php");



session_start();
$db = new Database();
$con = $db->connect_db();
$id = $_SESSION['USERID'];

$admin = new Admin();
if ($admin->is_admin($id) == false) {
    header("location: no_access.php");
}

// $value = array();
// for ($i = 1; $i < 6; $i++) {
//     $value += array($i => $i + 10);
// }

// $value = $admin->findLast7DayUser();
// $value2 = $admin->findLast30daysRevenue();

$pro = new Product();
$most_sold = $pro->mostSoldProduct();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/profile.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <title>Document</title>

    <style>
        body {
            background-color: #e0e0e0;
        }

        .container>.card:nth-of-type(1) {
            border-radius: 0;
        }

        .container>.card:nth-of-type(1) ul {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            padding: 0;
            margin: 0;
        }

        @media only screen and (max-width: 600px) {
            .container>.card:nth-of-type(1) ul {
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <?php include "utility/admin_navbar.php" ?>

    <div class="container">
        <div class="card bg-dark mt-3 mb-3">
            <ul>
                <a class="text-warning" href="admin_dashboard.php">Dashboard</a>
                <a class="text-light" href="admin_orders.php">Orders</a>
                <a class="text-light" href="admin_out_for_delivery.php">Out for Delivery</a>
                <a class="text-light" href="admin_delivery.php">Delivered</a>
            </ul>
        </div>

        <div id="section2" class="mb-3">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <h5>Total Products</h5>
                        <h2><?php echo $admin->findTotalProducts()  ?></h2>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <h5>Total Revenue</h5>
                        <h2>$<?php echo $admin->findTotalRevenue() ?></h2>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <h5>Total Orders</h5>
                        <h2>300</h2>
                    </div>
                </div>
            </div>
        </div>


        <div id="section3" class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <h5>Total Active User</h5>
                        <h2>300</h2>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card bg-dark text-light">
                        <h5>Total Sold Product</h5>
                        <h2>300</h2>
                    </div>
                </div>
            </div>
        </div>


        <div id="section3" class="mb-3">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card ">
                        <div class="card mt-3">
                            <h5>Most Sold</h5>
                            <hr>
                            <a href="product_detail.php?product_id=<?php echo $most_sold['product_id'] ?>"><img src="<?php echo $most_sold['photo'] ?>" alt="" width="100%"></a>


                        </div>
                        <div class="card mt-3">
                            <h5>Most Viewed</h5>
                            <img src="images/headphone.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-3">
                    <div class="card bg-dark">
                        <h5 class="text-light">Latest Product Reviews</h5>

                        <div class="card mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="images/headphone.jpg" alt="" height="110px" width="150px">
                                </div>
                                <div class="col-md-9">
                                    <h6>Rifat</h6>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Et quas voluptatem, nobis adipisci eligendi autem assumenda dolores sequi eveniet, quos rem facere quis voluptatibus expedita quae sit delectus distinctio? Doloribus.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="images/headphone.jpg" alt="" height="110px" width="150px">
                                </div>
                                <div class="col-md-9">
                                    <h6>Rifat</h6>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Et quas voluptatem, nobis adipisci eligendi autem assumenda dolores sequi eveniet, quos rem facere quis voluptatibus expedita quae sit delectus distinctio? Doloribus.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="images/headphone.jpg" alt="" height="110px" width="150px">
                                </div>
                                <div class="col-md-9">
                                    <h6>Rifat</h6>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Et quas voluptatem, nobis adipisci eligendi autem assumenda dolores sequi eveniet, quos rem facere quis voluptatibus expedita quae sit delectus distinctio? Doloribus.</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>


</body>


</html>