<?php

session_start();
include '../model/User.php';

$success_msg= "";
$warning_msg= "";
$redirect_url= "";

if(!isset($_SESSION['user_id'])){
    header('location: LoginController.php');
    exit();
}

$user_id = $_SESSION['user_id'];


if(isset($_POST['update'])){
    $name= $_POST['name'];
    $email= $_POST['email'];
    $number= $_POST['number'];
    $address= $_POST['address'];
    $password= $_POST['password'];

    if(empty($name) || empty($email) || empty($number) || empty($address) || empty($password)){
        $warning_msg = "All fields are required!";
    } 
    else {
        $result = updateUserProfile($user_id, $name, $email, $number, $address, $password);
        
        if($result === true){
            session_unset();
            session_destroy();
            
            $success_msg = "Profile updated successfully! Please login again.";
            $redirect_url = "../controller/LoginController.php";
        } else {
            $warning_msg = "Something went wrong: " . $result;
        }
    }
}


if($redirect_url == ""){
    $fetch_profile = getUserById($user_id);
} else {
    $fetch_profile = [];
}

include '../view/user_profile.php';
?>