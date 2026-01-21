<?php
function checkCartItem($user_id, $p_name){
    $conn= mysqli_connect("localhost", "root", "", "hapani");

    $p_name= mysqli_real_escape_string($conn, $p_name);
    $user_id= mysqli_real_escape_string($conn, $user_id);

    $sql= "SELECT * FROM cart WHERE name = '$p_name' AND user_id = '$user_id'";
    $result= mysqli_query($conn, $sql);
        
    $cartList= (mysqli_num_rows($result) > 0);
    mysqli_close($conn);
    
    return $cartList;
}

function addToCart($user_id, $pid, $name, $price, $qty, $image)
{
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $name= mysqli_real_escape_string($conn, $name);    
    $sql= "INSERT INTO cart (user_id, product_id, name, price, quantity, image) VALUES ('$user_id', '$pid', '$name', '$price', '$qty', '$image')";
    
    $result= mysqli_query($conn, $sql);
    mysqli_close($conn);    
    return $result;
}

function getCartItems($user_id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $user_id= mysqli_real_escape_string($conn, $user_id);
    
    $sql= "SELECT * FROM cart WHERE user_id= '$user_id'";
    $result= mysqli_query($conn, $sql);
    return $result; 
}

function updateCartQuantity($cart_id, $qty) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $cart_id= mysqli_real_escape_string($conn, $cart_id);
    $qty= mysqli_real_escape_string($conn, $qty);
    
    $sql= "UPDATE cart SET quantity = '$qty' WHERE cart_id = '$cart_id'";
    $result= mysqli_query($conn, $sql);
    
    mysqli_close($conn);
    return $result;
}

function deleteCartItem($cart_id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $cart_id= mysqli_real_escape_string($conn, $cart_id);
    
    $sql= "DELETE FROM cart WHERE cart_id = '$cart_id'";
    $result= mysqli_query($conn, $sql); 

    mysqli_close($conn);
    return $result;
}

function deleteAllCartItems($user_id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $user_id= mysqli_real_escape_string($conn, $user_id);    

    $sql= "DELETE FROM cart WHERE user_id = '$user_id'";
    $result= mysqli_query($conn, $sql);    
    
    mysqli_close($conn);
    return $result;
}
?>
