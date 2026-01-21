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

function registerUser($name, $email, $password, $number, $address) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    if(!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error()); 
            }

    $name= mysqli_real_escape_string($conn, $name);
    $email= mysqli_real_escape_string($conn, $email);
    $password= mysqli_real_escape_string($conn, $password);
    $number= mysqli_real_escape_string($conn, $number);
    $address= mysqli_real_escape_string($conn, $address);

    $check_email= mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    
    if(mysqli_num_rows($check_email) > 0){
        mysqli_close($conn);
        return "exists";
    } 
    else {
        $sql= "INSERT INTO user (name, email, password, number, address, user_type) VALUES ('$name', '$email', '$password', '$number', '$address', 'user')";
        
        if(mysqli_query($conn, $sql)){
            mysqli_close($conn);
            return true;
        } 
        else {
            $error= mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    }
}


function getUserById($user_id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $user_id= mysqli_real_escape_string($conn, $user_id);
    
    $sql= "SELECT * FROM user WHERE user_id = '$user_id'";
    $result= mysqli_query($conn, $sql);
    
    $data= mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $data;
}

function updateUserProfile($user_id, $name, $email, $number, $address, $password) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    
    // Security
    $user_id= mysqli_real_escape_string($conn, $user_id);
    $name= mysqli_real_escape_string($conn, $name);
    $email= mysqli_real_escape_string($conn, $email);
    $number= mysqli_real_escape_string($conn, $number);
    $address= mysqli_real_escape_string($conn, $address);
    $password= mysqli_real_escape_string($conn, $password);

    $sql= "UPDATE `user` SET name = '$name', email = '$email', number = '$number', address = '$address', password = '$password' WHERE user_id = '$user_id'";
    
    if(mysqli_query($conn, $sql)){
        mysqli_close($conn);
        return true;
    } else {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        return $error;
    }
}

function resetUserPassword($email, $password) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // 1. Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    
    if (mysqli_num_rows($check) > 0) {
        $update = "UPDATE user SET password = '$password' WHERE email = '$email'";
        if (mysqli_query($conn, $update)) {
            mysqli_close($conn);
            return true;
        } else {
            return mysqli_error($conn);
        }
    } else {
        return "Email address not found in our system.";
    }
}


?>
