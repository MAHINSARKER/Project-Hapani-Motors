<?php

function getSupportById($id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $id= mysqli_real_escape_string($conn, $id);
    
    $query= "SELECT * FROM user WHERE user_id = '$id'";
    $result= mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function updateSupportProfile($id, $name, $email, $number, $address, $password) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    
    $id= mysqli_real_escape_string($conn, $id);
    $name= mysqli_real_escape_string($conn, $name);
    $email= mysqli_real_escape_string($conn, $email);
    $number= mysqli_real_escape_string($conn, $number);
    $address= mysqli_real_escape_string($conn, $address);
    $password= mysqli_real_escape_string($conn, $password);

    $sql= "UPDATE user SET name = '$name', email = '$email', number = '$number', address = '$address', password = '$password' WHERE user_id = '$id'";
    
    if(mysqli_query($conn, $sql)){
        return true;
    } 
    
    else {
        return mysqli_error($conn);
    }
}


function getCustomers($search = '') {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    $search = mysqli_real_escape_string($conn, $search);
    
    // Fetch only normal 'user' types, not admins or support
    if(!empty($search)){
        $query = "SELECT * FROM user WHERE user_type = 'user' AND name LIKE '%$search%'";
    } 
    else {
        $query = "SELECT * FROM user WHERE user_type = 'user'";
    }
    
    $result = mysqli_query($conn, $query);
    $data = [];
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
    }
    return $data;
}

function deleteCustomer($id) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    $id = mysqli_real_escape_string($conn, $id);
    
    $check = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$id' AND user_type = 'user'");    
    if(mysqli_num_rows($check) > 0){
        $delete = mysqli_query($conn, "DELETE FROM user WHERE user_id = '$id'");
        if($delete) return true;
        else return mysqli_error($conn);
    } 
    
    else {
        return "User not found or you cannot delete this user type.";
    }
}

function registerSupport($name, $email, $password, $number, $address) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");    
    $name= mysqli_real_escape_string($conn, $name);
    $email= mysqli_real_escape_string($conn, $email);
    $password= mysqli_real_escape_string($conn, $password);
    $number= mysqli_real_escape_string($conn, $number);
    $address = mysqli_real_escape_string($conn, $address);


    $check_email = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    
    if(mysqli_num_rows($check_email) > 0){
        return "Email already exists!";
    } 
    else{
        $sql = "INSERT INTO user (name, email, password, number, address, user_type) VALUES ('$name', '$email', '$password', '$number', '$address', 'support')";
        
        if(mysqli_query($conn, $sql)){
            return true;
        } 
        
        else {
            return mysqli_error($conn);
        }
    }
}

function getAllOrders() {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    
    $query = "SELECT * FROM `orders` ORDER BY order_id DESC";
    $result = mysqli_query($conn, $query);
    
    $orders = [];
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $orders[] = $row;
        }
    }
    return $orders;
}

function updateOrderToDelivered($order_id) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    $order_id = mysqli_real_escape_string($conn, $order_id);
    
    $query = "UPDATE orders SET comment = 'Delivered' WHERE order_id = '$order_id'";
    
    if(mysqli_query($conn, $query)){
        return true;
    } else {
        return mysqli_error($conn);
    }
}

function getAllMessages() {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    
    $query = "SELECT * FROM contact ORDER BY contact_id DESC";
    $result = mysqli_query($conn, $query);
    
    $messages = [];
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $messages[] = $row;
        }
    }
    return $messages;
}
?>
