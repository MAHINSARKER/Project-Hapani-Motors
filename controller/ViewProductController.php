<?php
session_start();
include '../model/product.php';
include '../model/cart.php';

$success_msg= "";
$warning_msg= "";
$fetch_product= null;

if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
    $fetch_product = getProductById($pid);
}

if(isset($_POST['add_to_cart'])){
    if(!isset($_SESSION['user_id'])){
        header('location: LoginController.php');
    } 
    else{
        $user_id= $_SESSION['user_id'];
        $pid= $_POST['pid'];
        $name= $_POST['name'];
        $price= $_POST['price'];
        $image= $_POST['image'];
        $qty= $_POST['qty'];
        
        if(checkCartItem($user_id, $name)){
            $warning_msg = "Product already added to cart!";
        } 
        else{
            addToCart($user_id, $pid, $name, $price, $qty, $image);
            $success_msg = "Added to cart successfully!";
        }
    }
}

include '../view/user_view_product.php';
?>