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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $_POST['id'] = $_SESSION['USERID'];
    $product->addProduct($_POST, $_FILES);
}

$product_id = "";
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
} else {
    header("location: 404.php");
}

$pro = new Product();
$product = "";
if ($pro->findProductById($product_id) != null) {
    $product = $pro->findProductById($product_id);
} else {
    header("location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = new Product();
    $_POST['id'] = $_SESSION['USERID'];
    $_POST['product_id'] = $product_id;
    $product->updateProduct($_POST);
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

        .dropdown-menu {
            max-height: 280px;
            overflow-y: auto;
            /* border: 1px solid red; */
        }

        .select {
            height: 30px;
            /* border: 1px solid red; */
            text-align: center;
            border-radius: 5px;
        }

        #catCard {
            margin-left: auto;
            margin-right: auto;
            border-radius: 0;
            margin-top: 0;
        }

        #cardHeader {
            margin-left: auto;
            margin-right: auto;
            width: 70rem;
            margin-bottom: 0;
            text-align: center;
        }
    </style>

</head>

<body>

    <?php include "utility/admin_navbar.php" ?>



    <div id="cardHeader" class="mt-5">
        <h2 class="bg-dark text-danger p-3">UPDATE PRODUCT</h2>
    </div>


    <div id="catCard" class="card p-4 mb-5" style="width:70rem;">
        <form method="POST" action="" >

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input name="title" type="text" value="<?php echo $product['name'] ?>" id="form6Example3" class="form-control" required />
                <label class="form-label" for="form6Example3">Product Name</label>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <textarea id="form6Example3" class="form-control" rows="8" name="description"><?php echo $product['description'] ?></textarea>
                <label class="form-label" for="form6Example3">Product Description</label>
            </div>





            <div class="mb-4">
                <select class="select w-100" name="category">
                    <div class="selectOption">
                        <option selected disabled>Choose Category</option>

                        <?php
                        // $cat = new Category();
                        // $result = $cat->getAllCategories();

                        $db = new Database();
                        $con = $db->connect_db();

                        $query = "SELECT * FROM category";
                        $result = mysqli_query($con, $query);
                        // echo $result;
                        if (mysqli_num_rows($result) > 0) {

                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <!-- <li class="dropdown-item" value=<?php echo $row['name'] ?> name="category"><?php echo $row['name'] ?></li> -->
                                <option <?php if($product['category_id']== $row['id']){?>  selected <?php }?> value=<?php echo $row['id'] ?>><?php echo $row['title'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </select>
            </div>







            <div class="form-outline mb-4">
                <input name="price" value="<?php echo $product['price'] ?>" type="number" min="0" id="form6Example3" class="form-control" />
                <label class="form-label" for="form6Example3">Price</label>
            </div>

            <div class="form-outline mb-4">
                <input name="quantity" value="<?php echo $product['quantity'] ?>" type="number" min="0" id="form6Example3" class="form-control" />
                <label class="form-label" for="form6Example3">Quantity</label>
            </div>

            <hr>

            <!-- Submit button -->
            <button name="submit" type="submit" class="btn btn-dark btn-block mb-4">Save</button>
        </form>
    </div>


    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>