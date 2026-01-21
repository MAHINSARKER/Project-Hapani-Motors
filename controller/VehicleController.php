<?php

session_start();
require_once '../model/product.php';
require_once '../model/cart.php';

$success_msg= "";
$warning_msg= "";

if(isset($_POST['add_to_cart'])){

    if(!isset($_SESSION['user_id'])){
        $warning_msg = "Please LOGIN to Add Items To Your Cart!";
        } 

        else{
        $user_id= $_SESSION['user_id'];
        $user_id= $_SESSION['user_id'];
        $pid= $_POST['pid'];
        $p_name= $_POST['p_name'];
        $p_price= $_POST['p_price'];
        $p_image= $_POST['p_image'];
        $p_qty= $_POST['p_qty'];

        
        if(checkCartItem($user_id, $p_name)){
            $warning_msg = "Product Already Added To Cart!";
        } 
        else{
            addToCart($user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
            $success_msg = "Product Added to Cart Successfully!";
        }
    }
}

$products = getAllProducts();
include '../view/user_vehicle.php';

?>