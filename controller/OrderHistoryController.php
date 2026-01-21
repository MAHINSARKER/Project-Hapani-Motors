<?php

session_start();
include '../model/Order.php';


if(!isset($_SESSION['user_id'])){
    header('location: LoginController.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$select_orders = getUserOrders($user_id);

include '../view/user_orders.php';
?>