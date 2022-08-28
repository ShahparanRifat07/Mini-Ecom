<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/category.php");
require_once("models/product.php");


session_start();
$db = new Database();
$con = $db->connect_db();

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}

$user = new User();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css" rel="stylesheet" />
    <title>Mini-Ecom</title>

    <style>
        body {
            background-color: #e0e0e0;
        }


        .photo {
            height: 25vh;
        }

        #carouselExampleIndicators {
            height: 60vh;
            overflow: hidden;
        }

        .card {
            border-radius: 0;
        }

        .middle {
            margin-left: auto;
            margin-right: auto;
        }

        .setH {
            height: 120px;
        }

        .setP {
            height: 180px;
            overflow-x: hidden;
        }

        .fixedS {
            height: 300px;
        }

        .priceStyle {
            margin-top: 2px;
            margin-bottom: 2px;
            padding: 0;
            /* border: 1px solid red; */
        }
        #lastButton{
            margin-left: 40%;
            margin-right: 40%;
        }
    </style>
</head>

<body>

    <?php include "utility/navbar.php" ?>

    <div id="mainSection" class="container">


        <div id="carouselExampleIndicators" class="carousel slide mt-3 mb-3" data-mdb-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/carosol5.webp" class="d-block w-100" alt="Wild Landscape" />
                </div>
                <div class="carousel-item">
                    <img src="images/carosol3.jpg" class="d-block w-100" alt="Camera" />
                </div>
                <div class="carousel-item">
                    <img src="images/carosol4.jpg" class="d-block w-100" alt="Exotic Fruits" />
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>



        <!-- Category -->
        <!-- Category -->
        <!-- Category -->
        <!-- Category -->

        <div class="card mb-3 bg-dark ">
            <h4 class="text-light">Categories</h4>
            <div class="row">
                <?php

                $cat = new Category();
                $cat_result = $cat->getAllCategories();
                if ($cat_result->num_rows > 0) {
                    while ($row = $cat_result->fetch_assoc()) {


                ?>
                        <div class="col-2">
                            <div class="card">

                                <img class="setH" src="<?php echo $row['photo']  ?>" alt="">


                                <p class="middle"><a class="text-dark" href=""><?php echo $row['title']  ?></a></p>

                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <li>
                        <a href="">Sorry!! no product available right now</a>
                    </li>
                <?php
                }
                ?>
            </div>

        </div>





        <!-- <p>Newly arrived prtodu</p> -->
        <!-- <p>Newly arrived prtodu</p> -->
        <!-- <p>Newly arrived prtodu</p> -->

        <div class="card mb-3">
            <h4>Newly Arrived</h4>

            <div class="row">
                <?php
                $query = "SELECT * FROM `product`
                WHERE product.quantity > 0
                ORDER BY created_time DESC  
                LIMIT 12";

                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-2">
                            <div class="card mb-2 fixedS">
                                <img class="setP" src="<?php echo $row['photo']  ?>" alt="">
                                <p class="middle priceStyle"><a class="text-dark" href="product_detail.php?product_id=<?php echo $row['id'] ?>"><?php echo $row['name']  ?></a></p>
                                <p class="text-danger priceStyle">$<?php echo $row['price'] ?></p>

                            </div>
                        </div>
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
            </div>
        </div>





        <div class="card mb-3">
            <h4>Top Rated Products</h4>

            <div class="row">
                <?php
                $query = "SELECT * FROM `product`
                WHERE product.quantity > 0
                ORDER BY created_time DESC  
                LIMIT 6";

                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-2">
                            <div class="card mb-2 fixedS">

                                <img class="setP" src="<?php echo $row['photo']  ?>" alt="">
                                <p class="middle"><a class="text-dark" href=""><?php echo $row['name']  ?></a></p>

                            </div>
                        </div>
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
            </div>
        </div>




        <div class="card mb-3">
            <h4>Most Viewed Products</h4>

            <div class="row">
                <div class="col-2">
                    <div class="card mb-2">
                        <img class="setP" src="images/laptop.jpg" alt="">
                        <p class="middle"><a class="text-dark" href="">Demo</a></p>
                    </div>
                </div>


                <div class="col-2">
                    <div class="card mb-2">
                        <img class="setP" src="images/laptop.jpg" alt="">
                        <p class="middle"><a class="text-dark" href="">Demo</a></p>
                    </div>
                </div>

                <div class="col-2">
                    <div class="card mb-2">
                        <img class="setP" src="images/laptop.jpg" alt="">
                        <p class="middle"><a class="text-dark" href="">Demo</a></p>
                    </div>
                </div>


            </div>
        </div>


        <div id="lastButton" class="mt-3 mb-3">
            <a class="btn btn-dark " href="all_product.php">view all products</a>
        </div>

    </div>


    <?php include "utility/footer.php" ?>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
</body>

</html>