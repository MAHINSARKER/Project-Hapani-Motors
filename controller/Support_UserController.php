<?php

session_start();
include '../model/support_model.php';

if(!isset($_SESSION['user_id'])){
    header('location: Admin_LoginController.php');
    exit;
}

$success_msg = "";
$warning_msg = "";
$redirect_url = "";


if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];
    $result= deleteCustomer($delete_id);

    if($result === true){
        $success_msg= "User removed successfully!";
        $redirect_url= "Support_UserController.php";
    } 
    
    else {
        $warning_msg = $result;
    }
}

$search_input = "";
if(isset($_POST['search_btn'])){
    $search_input = $_POST['search_box'];
}

$customer_list = getCustomers($search_input);


include '../view/support_manage_users.php';
?>