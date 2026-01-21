<?php
session_start();
include '../model/support_model.php';

if(!isset($_SESSION['user_id'])){
    header('location: UserAuthController.php');
    exit;
}

$user_id= $_SESSION['user_id'];
$success_msg= "";
$warning_msg= "";
$redirect_login= false;
$fetch_profile= [];

// 2. Handle Update
if (isset($_POST['update'])) {
    $name= $_POST['name'];
    $email= $_POST['email'];
    $number= $_POST['number'];
    $address= $_POST['address'];
    $password= $_POST['password'];

    if (empty($name) || empty($email) || empty($number) || empty($address) || empty($password)) {
        $warning_msg = "All fields are required!";
    } 
    
    else {
        $result = updateSupportProfile($user_id, $name, $email, $number, $address, $password);

        if ($result === true) {
            session_unset();
            session_destroy();
            $success_msg = "Profile updated! Please login again.";
            $redirect_login = true; 
        } 
        
        else {
            $warning_msg = "Error: " . $result;
        }
    }
}


if(!$redirect_login){
    $fetch_profile = getSupportById($user_id);
}


include '../view/support_profile_update.php';
?>