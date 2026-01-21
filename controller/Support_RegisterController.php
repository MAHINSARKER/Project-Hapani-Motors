<?php

session_start();

include '../model/support_model.php';

$success_msg= "";
$warning_msg= "";
$redirect_url= "";

if(isset($_POST['submit'])){
    
    $name= $_POST['name'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $number= $_POST['number'];
    $address= $_POST['address'];

    $result = registerSupport($name, $email, $password, $number, $address);

    if ($result === true) {
        $success_msg = "Support Registration successful! Please Login.";
        $redirect_url = "Admin_LoginController.php";
    } 
    elseif ($result === "exists") {
        $warning_msg = "User email already exists!";
    } 
    else {
        $warning_msg = "Query Failed: " . $result;
    }
}

include '../view/support_register.php';
?>