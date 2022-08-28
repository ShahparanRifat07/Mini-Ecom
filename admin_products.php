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
    </style>
</head>

<body>

    <?php include "utility/admin_navbar.php" ?>







    <div class="container mt-3 mb-3">
        <h2 class="mt-5">All Products</h2>
        <hr>
        <table class="table align-middle mb-5 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th>Update Product</th>
                    <th>Delete Product</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM `product`
                WHERE product.quantity > 0
                ORDER BY created_time DESC  
                LIMIT 12";
                $cat = new Category();
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $category = $cat->findCategoryById($row['category_id']);
                        
                ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo $row['photo']  ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <a class="fw-bold mb-1" href="product_detail.php?product_id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $category['title'] ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">$<?php echo $row['price'] ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['quantity'] ?> </p>
                            </td>
                            <td>
                                <a class="btn btn-warning btn-sm btn-rounded" href="">Change Picture</a>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm btn-rounded" href="update_product.php?product_id=<?php echo $row['id'] ?>">Update</a>
                            </td>
                            <td>
                                <a onclick="wannaDelete()" class="btn btn-danger btn-sm btn-rounded" href="delete_product.php?product_id=<?php echo $row['id'] ?>">Delete</a>
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
            alert("Do you want to Delete this product?");
        }
    </script>


</body>

</html>