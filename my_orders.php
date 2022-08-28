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
    </style>

</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div id="mainSection" class="container">
        <h2 class="mt-5">My Orders</h2>
        <hr>
        <div class="card mb-5">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <?php
                    $query = "SELECT * 
                    FROM `product_order`
                    JOIN product
                    ON product_order.product_id = product.id
                    WHERE product_order.user_id = '$user_id'";

                    $cat = new Category();
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                    ?>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Shipping Address</th>
                            <th>Status</th>
                            <th>Transaction ID</th>
                            <th>Ordered Date</th>
                        </tr>
                </thead>
                <tbody>


                    <?php

                        while ($row = mysqli_fetch_assoc($result)) {
                            $category = $cat->findCategoryById($row['category_id']);

                    ?>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo $row['photo'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?php echo $row['name'] ?></p>
                                        <p class="text-muted mb-0"><?php echo $category['title'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-danger">$<?php echo $row['price'] ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['street'] ?>, <?php echo $row['city'] ?></p>
                                <p class="fw-normal mb-0"><?php echo $row['zip'] ?>, <?php echo $row['country'] ?></p>
                            </td>
                            <td>
                                <?php
                                if ($row['on_process'] == 1 && $row['delivered'] == 0) {
                                ?>
                                    <span class="badge badge-primary rounded-pill d-inline">In Process</span>
                                <?php
                                } else if ($row['on_process'] == 0 && $row['delivered'] == 1) {
                                ?>
                                    <span class="badge badge-success rounded-pill d-inline">Delivered</span>
                                <?php
                                } else {
                                ?>
                                    <span class="badge badge-warning rounded-pill d-inline">Ordered</span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <p><?php echo $row['transaction_id'] ?></p>
                            </td>
                            <td>
                                <p><?php echo $row['created_time'] ?></p>
                            </td>
                        </tr>



                    <?php
                        }
                    ?>
                </tbody>
            <?php
                    } else {
            ?>
                <p>NO ORDERS FOUND</p>
            <?php
                    }
            ?>
            </table>
        </div>

    </div>
    <?php include "utility/footer.php" ?>


    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"></script>



</body>


</html>