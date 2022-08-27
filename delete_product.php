<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/product.php");
require_once("models/admin.php");


$product_id = "";
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
}

$product = new Product();
$product->deleteProduct($product_id);


?>