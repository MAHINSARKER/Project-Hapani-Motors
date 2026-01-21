<?php


session_start();
include '../model/support_model.php';

if(!isset($_SESSION['user_id'])){
    header('location: Admin_LoginController.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$success_msg = "";
$error_msg = "";


if(isset($_POST['update_status'])){
    $order_id_to_update = $_POST['order_id'];
    
    $result = updateOrderToDelivered($order_id_to_update);
    
    if($result === true){
        $success_msg = "Order $order_id_to_update status updated to Delivered!";
    } else {
        $error_msg = "Failed to update status: " . $result;
    }
}


$fetch_profile = getSupportById($user_id);
$orders_list = getAllOrders();         


include '../view/support_dashboard.php';
?>