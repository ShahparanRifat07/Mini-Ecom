<?php
require_once("models/database.php");
require_once("models/user.php");
session_start();
$db = new Database();
$con = $db->connect_db();
$user_id = $_SESSION['USERID'];
$query1 = "UPDATE user SET 	is_loggedin = 0 WHERE id = $user_id";
$db->save($query1);
session_destroy();
header("Location: signin.php");
