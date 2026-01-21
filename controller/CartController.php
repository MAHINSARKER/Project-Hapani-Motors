<?php

session_start();
include '../model/cart.php';

$success_msg= "";
$warning_msg= "";

if(!isset($_SESSION['user_id'])){
    header('location: ../controller/LoginController.php');
    exit();
}

$user_id = $_SESSION['user_id'];
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    deleteCartItem($delete_id);
    header('location: ../controller/CartController.php');
    exit();
}

if(isset($_GET['delete_all'])){
    deleteAllCartItems($user_id);
    header('location: ../controller/CartController.php');
    exit();
}

if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $p_qty = $_POST['p_qty'];
    
    if(updateCartQuantity($cart_id, $p_qty)){
        $success_msg = "Cart Updated Successfully!";
    } else {
        $warning_msg = "Could not update cart.";
    }
}


$select_cart = getCartItems($user_id);


include '../view/user_cart.php';
?>