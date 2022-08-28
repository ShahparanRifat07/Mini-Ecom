<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/admin.php");
require_once("models/category.php");
require_once("models/product.php");

session_start();

$id = "";
if (isset($_SESSION['LOGGEDIN'])) {
    $id = $_SESSION['USERID'];
}

$product_id = "";
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
} else {
    header("location: 404.php");
}


$pro = new Product();
$product = "";
if ($pro->findProductById($product_id) !== null) {
    $product = $pro->findProductById($product_id);
} else {
    header("location: 404.php");
}


$cat = new Category();
$category = $cat->findCategoryById($product['category_id']);
$category_name = $category['title'];


$user = new User();
$is_bought = $user->checkIfProductBoughtByUser($product_id, $id);
$is_admin = $user->checkIFAdmin($id);





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

        .proImg {
            width: 100%;
            height: 400px;
        }

        .btnW {
            width: 25%;
        }

        .centerB {
            display: flex;
            text-align: center;
            justify-content: center;
        }






        .modal-rating {
            background-color: #262626;
            padding: 20px;
            color: #FFFFFF;
            font-family: sans-serif;
            max-width: 350px;
            width: 95%;
            border-radius: 10px;

            position: relative;
        }

        .modal-rating .overlay {
            position: absolute;
            inset: 0;
            z-index: -1;
            background-color: #FB7711;
            border-radius: 10px;
            transform: translate(-5px, 5px);
        }


        .modal-rating i {
            color: #FB7711;
            background-color: #26303B;
            padding: 10px;
            border-radius: 50%;
        }

        .modal-rating h2 {
            font-size: 20px;
            margin-bottom: 0px;
        }

        .modal-rating p {
            font-size: 13px;
            color: #a4a9b2;
        }

        .modal-rating .rating {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-direction: row;
        }

        .modal-rating .rating input[type="radio"] {
            display: none;
        }

        .modal-rating .rating label {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 1em;
            height: 1em;
            padding: 20px;
            font-size: 20px;
            margin-top: 25px;

            color: #a4a9b2;
            background-color: #26303B;
            border-radius: 50%;
            cursor: pointer;
        }

        .modal-rating .rating label:hover {
            background-color: #7C8897;
            color: #FFFFFF;
        }

        .modal-rating .rating input:checked+label {
            background-color: #FB7711;
            color: #FFFFFF;
        }


        .modal-rating button[type="submit"] {
            background-color: #FB7711;
            color: #FFFFFF;
            width: 100%;
            padding: 10px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 99px;
            border: 0px;
            margin-top: 25px;
            cursor: pointer;
        }

        .modal-rating button[type="submit"]:hover {
            color: #FB7711;
            background-color: #FFFFFF;
        }
    </style>
</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div id="mainSection" class="container">

        <div class="card p-5 mt-3 mb-3">
            <div class="row">

                <div class="col-md-4">
                    <img class="proImg" src="<?php echo $product['photo'] ?>" alt="">
                </div>
                <div class="col-md-8">
                    <div class="ms-5">
                        <h1><?php echo $product['name'] ?></h1>
                        <p class="mt-5"><?php echo $product['description'] ?></p>
                        <h2 class="mt-5 text-danger">$.<?php echo $product['price'] ?></h2>
                    </div>

                    <div class="ms-5 mt-5">
                        <a class="btn btn-light btnW" href="">Add to wishlist</a>
                        <a class="btn btn-dark btnW ms-2" href="product_checkout.php?product_id=<?php echo $product_id  ?>&user_id=<?php echo $id ?>"> Buy Now</a>
                    </div>
                </div>

            </div>
        </div>


        <?php

        if ($is_admin == true) {
        ?>




            <div class="card mt-3 mb-3">
                <h4 class="middle">Actions</h4>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <a class="btn btn-dark text-warning centerB" href="">Change Picture</a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-dark text-warning centerB" href="update_product.php?product_id=<?php echo $product_id?>">Update Product</a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-dark text-danger centerB" href="">Delete Product</a>
                    </div>
                </div>
            </div>


            <div class="card mt-3 mb-3">
                <h4 class="middle">Product Insights</h4>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <h6>Product Remaining</h6>
                        <h4>150 </h4>
                    </div>
                    <div class="col-md-3">
                        <h6>Product Sold</h6>
                        <h4>30</h4>
                    </div>
                    <div class="col-md-3">
                        <h6>Total Revenue From Product</h6>
                        <h4>$12000</h4>
                    </div>
                    <div class="col-md-3">
                        <h6>Total View</h6>
                        <h4>420</h4>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <div class="row  mt-3 mb-3">
            <div class="col-md-3">
                <div class="card">

                    <?php if ($is_bought == True) { ?>

                        <form class="modal-rating">
                            <div class="overlay"></div>
                            <i class="fa-solid fa-star"></i>
                            <h2>Rate This Product</h2>
                            <div class="rating">
                                <input type="radio" name="rate" id="rate-1" value="1" required>
                                <label for="rate-1">1</label>

                                <input type="radio" name="rate" id="rate-2" value="2" required>
                                <label for="rate-2">2</label>

                                <input type="radio" name="rate" id="rate-3" value="3" required>
                                <label for="rate-3">3</label>

                                <input type="radio" name="rate" id="rate-4" value="4" required>
                                <label for="rate-4">4</label>

                                <input type="radio" name="rate" id="rate-5" value="5" required>
                                <label for="rate-5">5</label>

                            </div>
                            <button type="submit">Rate</button>
                        </form>

                    <?php
                    }
                    ?>


                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <form method="POST" action="">
                        <div class="form-outline mb-4">
                            <textarea name="review" class="form-control" id="form4Example3" rows="3"></textarea>
                            <label class="form-label" for="form4Example3">Write a Review</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-dark btn-block" <?php if ($is_bought == false) { ?> disabled <?php } ?>>Post</button>
                    </form>
                </div>

                <div class="card mt-3">
                    <div>
                        <h6>Review by - Rifat</h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni asperiores quo neque consequatur, perspiciatis vel temporibus in praesentium! Ut id ducimus voluptas deleniti architecto quibusdam cupiditate repellat culpa numquam exercitationem!</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div>
                        <h6>Review by - Rifat</h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni asperiores quo neque consequatur, perspiciatis vel temporibus in praesentium! Ut id ducimus voluptas deleniti architecto quibusdam cupiditate repellat culpa numquam exercitationem!</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div>
                        <h6>Review by - Rifat</h6>
                        <hr>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni asperiores quo neque consequatur, perspiciatis vel temporibus in praesentium! Ut id ducimus voluptas deleniti architecto quibusdam cupiditate repellat culpa numquam exercitationem!</p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <?php include "utility/footer.php" ?>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
</body>

</body>

</html>