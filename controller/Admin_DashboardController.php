<?php

session_start();
include '../model/admin_dashboard.php';

if(!isset($_SESSION['user_id'])){
    header('location: Admin_LoginController.php');
    exit();
}

$total_revenue = getTotalRevenue();
$total_orders = getTotalOrdersCount();

include '../view/admin_dashboard.php';
?>