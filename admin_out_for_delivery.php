<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/admin.php");
require_once("models/category.php");
require_once("models/product.php");

session_start();

$id = $_SESSION['USERID'];

$admin = new Admin();
if ($admin->is_admin($id) == false) {
    header("location: no_access.php");
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






    <div class="container mt-3 mb-3">


        <div class="card bg-dark mt-3 mb-3">
            <ul>
                <a class="text-light" href="admin_dashboard.php">Dashboard</a>
                <a class="text-light" href="admin_orders.php">Orders</a>
                <a class="text-warning" href="admin_out_for_delivery.php">Out for Delivery</a>
                <a class="text-light" href="admin_delivery.php">Delivered</a>
            </ul>
        </div>

        <table class="table align-middle mb-5 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Product Name</th>
                    <th>Purchaser</th>
                    <th>Shipping Address</th>
                    <th>Transaction ID</th>
                    <th>Ordered Date</th>
                    <th>Delivered</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT product_order.id,product_id,user_id,p.name,p.category_id,p.price,p.photo,product_order.transaction_id,product_order.created_time,
                            product_order.street,product_order.city,product_order.zip,product_order.country,u.first_name,u.last_name,u.email,u.phone
                            FROM `product_order`
                            JOIN product as p
                            ON product_order.product_id = p.id
                            JOIN user as u
                            ON product_order.user_id = u.id
                            WHERE product_order.on_process = 1 AND product_order.delivered = 0
                            ORDER BY created_time DESC";

                $cat = new Category();
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
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
                                <p class="fw-bold mb-1"><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></p>
                                <p class="fw-normal mb-0"><?php echo $row['email'] ?></p>
                                <p class="fw-normal mb-0"><?php echo $row['phone'] ?></p>
                            </td>

                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['street'] ?>, <?php echo $row['city'] ?></p>
                                <p class="fw-normal mb-0"><?php echo $row['zip'] ?>, <?php echo $row['country'] ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['transaction_id'] ?> </p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['created_time'] ?> </p>
                            </td>
                            <td>
                                <a onclick="wannaDelete()" class="btn btn-danger btn-sm btn-rounded" href="product_delivered.php?order_id=<?php echo $row['id'] ?>">Confirm</a>
                            </td>
                        </tr>

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

            </tbody>
        </table>
    </div>






    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>

    <script>
        function wannaDelete() {
            alert("Do you want to ship this product?");
        }
    </script>


</body>

</html>