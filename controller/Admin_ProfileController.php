<?php

session_start();
include '../model/admin_user.php';


if (!isset($_SESSION['user_id'])) {
    header('location: AdminLoginController.php');
    exit;
}

$user_id= $_SESSION['user_id'];
$success_msg= "";
$warning_msg= "";
$redirect_login= false;
$fetch_profile= [];


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
        $result = updateAdminProfile($user_id, $name, $email, $number, $address, $password);

        if ($result === true) {
            session_unset();
            session_destroy();
            $success_msg = "Profile updated successfully! Please login again.";
            $redirect_login = true; 
        } 
        else {
            $warning_msg = "Something went wrong: " . $result;
        }
    }
}


if(!$redirect_login){
    $fetch_profile = getAdminById($user_id);
}


include '../view/admin_profile_update.php';
?>