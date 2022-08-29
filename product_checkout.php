<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/category.php");
require_once("models/product.php");


session_start();
$db = new Database();
$con = $db->connect_db();

if (!isset($_SESSION['LOGGEDIN'])) {
    header("location: signin.php");
}

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}

$product_id = "";

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
} else {
    header("location: 404.php");
}


$pro = new Product();
$product = $pro->findProductById($product_id);
$cat = new Category();
$category = $cat->findCategoryById($product['category_id']);

$us = new User();

$user = $us->findUserByUserId($user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $us->buyProduct($_POST,$product_id,$user_id);    
}


?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <link href="css/instructor.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <!-- <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

    <style>
        body {
            background-color: #e0e0e0;
        }

        .card {
            border-radius: 0;
            padding: 50px;
        }

        .middle {
            margin-left: auto;
            margin-right: auto;
        }

        #product_sum {
            display: flex;
            justify-content: space-evenly;
        }

        #price {
            text-align: end;
            margin-right: 10%;
        }
    </style>
</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div id="mainSection" class="container">
        <div class="row mt-3 mb-3">
            <div class="col-md-4">
                <div class="card">
                    <h5>Product Details</h5>
                    <hr>
                    <div id="product_sum">
                        <img src="<?php echo $product['photo'] ?>" alt="" width="80px" height="80px">
                        <div class="ms-4">
                            <h6><?php echo $product['name'] ?></h6>
                            <p><?php echo $category['title'] ?></p>
                            <h4 class="text-danger">$.<?php echo $product['price'] ?></h4>
                        </div>
                    </div>
                    <hr>
                    <div id="price">
                        <h3>Total: $<?php echo $product['price'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5>Personal Information</h5>
                    <hr>
                    <p>Name: <?php echo $user['first_name'] ?> <?php echo $user['last_name'] ?></p>
                    <p>Email: <?php echo $user['email'] ?></p>
                    <p>Phone: <?php echo $user['phone'] ?></p>

                    <h5 class="mt-4">Shipping Address</h5>
                    <hr>

                    <form id="form1" method="POST" action="">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input name="street" type="text" value="<?php echo $user['street'] ?>" id="form3Example1" class="form-control" />
                                    <label class="form-label" for="form3Example1">Street</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input name="city" type="text" value="<?php echo $user['city'] ?>" id="form3Example2" class="form-control" />
                                    <label class="form-label" for="form3Example2">City</label>
                                </div>
                            </div>
                        </div>

                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input name="zip" type="text" value="<?php echo $user['zip_code'] ?>" id="form3Example1" class="form-control" />
                                    <label class="form-label" for="form3Example1">Zip Code</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input name="country" type="text" value="<?php echo $user['country'] ?>" id="form3Example2" class="form-control" />
                                    <label class="form-label" for="form3Example2">Country</label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="submit-form" hidden/>
                    </form>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h5>Checkout</h5>
                    <hr>

                    <div class="form-outline mb-4">
                        <input form="form1" type="number" id="form3Example3" class="form-control" placeholder="1234 1234 1234 1234" required />
                        <label class="form-label" for="form3Example3">Card Number</label>
                    </div>

                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input form="form1" type="text" id="form3Example1" class="form-control" placeholder="MM/YY" required />
                                <label class="form-label" for="form3Example1">Expiration date</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input form="form1" type="text" id="form3Example2" class="form-control" placeholder="CVV" required />
                                <label class="form-label" for="form3Example2">Security code</label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button class="btn btn-dark btn-block mb-4" type="submit" form="form1">Confirm</button>
                    <!-- <button type="submit" >Confirm</button> -->
                </div>
            </div>
        </div>
    </div>


    <?php include "utility/footer.php" ?>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>

</body>

</html>