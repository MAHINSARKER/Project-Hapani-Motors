<?php

session_start();
include '../model/cart.php'; 
include '../model/order.php';
$success_msg= "";
$warning_msg= "";
$redirect_url= "";

if(!isset($_SESSION['user_id'])){
    header('location: LoginController.php');
    exit();
}
$user_id= $_SESSION['user_id'];

if(isset($_POST['order'])){
    $name= $_POST['name'];
    $number= $_POST['number'];
    $email= $_POST['email'];
    $method= $_POST['method'];    
    $address= $_POST['address'];

  
    $cart_total= 0;
    $cart_products= [];    
    $cart_query = getCartItems($user_id);

    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].')';

            $sub_total = ($cart_item['price'] * $cart_item['quantity']);

            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);

    if($cart_total == 0){
        $warning_msg = 'Your Cart is Empty';
    }
    elseif(checkOrderExists($name, $number, $email, $method, $address, $cart_total)){
        $warning_msg = 'Order placed ALREADY!';
    }
    else{
        createOrder($user_id, $name, $number, $email, $method, $address, $total_products, $cart_total);
        
        deleteAllCartItems($user_id);
        
        $success_msg = 'Order Placed Successfully!';
        $redirect_url = "HomeController.php"; 
    }
}

$select_cart_items = getCartItems($user_id);


include '../view/user_checkout.php';
?>