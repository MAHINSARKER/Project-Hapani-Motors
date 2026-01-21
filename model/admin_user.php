<?php
function verifyUser($email, $password) {
    
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    if(!$conn)
        { 
            die("Connection failed: " . mysqli_connect_error()); 
    }
    $email= mysqli_real_escape_string($conn, $email);
    $password= mysqli_real_escape_string($conn, $password);
    $sql= "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result= mysqli_query($conn, $sql);

    $userData= null;
    if(mysqli_num_rows($result) > 0){
        $userData = mysqli_fetch_assoc($result);
    }
    mysqli_close($conn);

    return $userData;
}

function getAdminById($id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $id= mysqli_real_escape_string($conn, $id);
    
    $query= "SELECT * FROM user WHERE user_id = '$id'";
    $result= mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function updateAdminProfile($id, $name, $email, $number, $address, $password) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    
    
    $id= mysqli_real_escape_string($conn, $id);
    $name= mysqli_real_escape_string($conn, $name);
    $email= mysqli_real_escape_string($conn, $email);
    $number= mysqli_real_escape_string($conn, $number);
    $address= mysqli_real_escape_string($conn, $address);
    $password= mysqli_real_escape_string($conn, $password);

    $update_query = "UPDATE user SET name = '$name', email = '$email', number = '$number', address = '$address', password = '$password' WHERE user_id = '$id'";
    
    if(mysqli_query($conn, $update_query)){
        return true;
    } 
    else {
        return mysqli_error($conn);
    }
}

function getSupportStaff($search = '') {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $search= mysqli_real_escape_string($conn, $search);
    
    if(!empty($search)){
        $query = "SELECT * FROM user WHERE user_type = 'support' AND name LIKE '%$search%'";
    } 
    
    else {
        $query = "SELECT * FROM user WHERE user_type = 'support'";
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

function deleteSupportStaff($id) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    $id = mysqli_real_escape_string($conn, $id);
    $check = mysqli_query($conn, "SELECT * FROM user WHERE user_id = '$id' AND user_type = 'support'");
    
    if(mysqli_num_rows($check) > 0){
        $delete = mysqli_query($conn, "DELETE FROM user WHERE user_id = '$id'");
        
        if($delete) return true;
        else return mysqli_error($conn);
    }
     else {
        return "User not found or not support staff.";
    }
}

function registerAdmin($name, $email, $password, $number, $address) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    
    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password); // Plain text as requested
    $number = mysqli_real_escape_string($conn, $number);
    $address = mysqli_real_escape_string($conn, $address);

    // 1. Check if email already exists
    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);
    
    if(mysqli_num_rows($result) > 0) {
        return "Email already registered!";
    }

    // 2. Insert new admin
    $query = "INSERT INTO user (name, email, password, number, address, user_type) 
              VALUES ('$name', '$email', '$password', '$number', '$address', 'admin')";
    
    if(mysqli_query($conn, $query)) {
        mysqli_close($conn);
        return true;
    } else {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        return $error;
    }
}
?>