<?php

function checkOrderExists($name, $number, $email, $method, $address, $total_price) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");

    $name = mysqli_real_escape_string($conn, $name);
    $number = mysqli_real_escape_string($conn, $number);
    $email = mysqli_real_escape_string($conn, $email);
    $method = mysqli_real_escape_string($conn, $method);
    $address = mysqli_real_escape_string($conn, $address);
    $total_price = mysqli_real_escape_string($conn, $total_price);

    $sql = "SELECT * FROM orders WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_price = '$total_price'";
    $result = mysqli_query($conn, $sql);
    
    $exists = (mysqli_num_rows($result) > 0);
    mysqli_close($conn);
    return $exists;
}

function createOrder($user_id, $name, $number, $email, $method, $address, $total_products, $total_price) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $name = mysqli_real_escape_string($conn, $name);
    $number = mysqli_real_escape_string($conn, $number);
    $email = mysqli_real_escape_string($conn, $email);
    $method = mysqli_real_escape_string($conn, $method);
    $address = mysqli_real_escape_string($conn, $address);
    $total_products = mysqli_real_escape_string($conn, $total_products);
    $total_price = mysqli_real_escape_string($conn, $total_price);
    $placed_on = date('d-M-Y');

    $sql = "INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, date, comment) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price', '$placed_on', 'Pending')";
    
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function getUserOrders($user_id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $user_id= mysqli_real_escape_string($conn, $user_id);
    
    $sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_id DESC";
    $result = mysqli_query($conn, $sql);
    
    return $result;
}
?>