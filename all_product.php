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

$pro = new Product();


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
            /* border: 1px solid red; */
        }

        .proImg {
            width: 100%;
            height: 400px;
        }

        .btnW {
            width: 25%;
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
        #header{
            /* border: 1px solid red; */
            display: flex;
        }
    </style>
</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div id="mainSection" class="container">
        <div id="header" class="bg-dark text-light p-4 mt-3">
            <h3 class="middle">ALL PRODUCTS</h3>
        </div>
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
                        <div class="card mt-2 mb-2 fixedS">
                            <img class="setP" src="<?php echo $row['photo']  ?>" alt="">
                            <p class="priceStyle"><a class="text-dark" href="product_detail.php?product_id=<?php echo $row['id'] ?>"><?php echo $row['name']  ?></a></p>
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


    <?php include "utility/footer.php" ?>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>
</body>

</body>

</html>