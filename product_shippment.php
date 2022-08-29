<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/product.php");
require_once("models/admin.php");


$admin = new Admin();
if ($admin->is_admin($id) == false) {
    header("location: no_access.php");
}

$order_id = "";
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
}


$product = new Product();


if($product->checkIfOrderExists($order_id) == false){
    header("location: 404.php");
}

$product->moveOrderToProcess($order_id);


?>