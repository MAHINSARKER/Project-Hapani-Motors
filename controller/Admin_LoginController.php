<?php
session_start();
include '../model/admin_user.php';

$warning_msg= ""; 
$success_msg= "";
$redirect_url= "";

if(isset($_SESSION['user_id'])){
    if($_SESSION['user_type']== 'admin'){
        header('location: ../admin/DashboardController.php');
        exit();
    } 
    elseif($_SESSION['user_type']== 'support'){
        header('location: ../support/DashboardController.php');
        exit();
    }
}

if(isset($_POST['submit'])){
   
    $email= $_POST['email'];
    $password= $_POST['password'];

    if(empty($email) || empty($password)){
        $warning_msg = "Please fill in all fields!";
    } 

    else {
        $row = verifyUser($email, $password);

        if($row) {
            switch($row['user_type']){
                case 'admin':
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_type'] = 'admin';                    
                    $success_msg = "Welcome Admin!";
                    $redirect_url = "Admin_DashboardController.php"; 
                    break;
                    
                case 'support':
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_type'] = 'support';                    
                    $success_msg = "Welcome Support Staff!";
                    $redirect_url = "Support_DashboardController.php";
                    break;
                    
                case 'user':
                    $warning_msg = "Access Denied! Customers please use the Customer Login.";
                    break;
                    
                default:
                    $warning_msg = "User type not recognized!";
            }
        } 
        
        else {
            $warning_msg = "Incorrect Email or Password!";
        }
    }
}

include '../view/admin_login.php';
?>