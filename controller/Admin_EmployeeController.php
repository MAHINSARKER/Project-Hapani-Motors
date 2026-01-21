<?php

session_start();
include '../model/admin_user.php';

if(!isset($_SESSION['user_id'])){
    header('location: Admin_LoginController.php');
    exit();
}

$success_msg= "";
$warning_msg= "";
$redirect_url= "";

if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];

    $result= deleteSupportStaff($delete_id);

    if($result === true){
        $success_msg= "Support staff removed successfully!";
        $redirect_url= "Admin_EmployeeController.php";
    } 
    
    else {
        $warning_msg= $result;
    }
}

$search_input= "";
if(isset($_POST['search_btn'])){
    $search_input = $_POST['search_box'];
}

$support_staff_list = getSupportStaff($search_input);

include '../view/admin_employee.php';
?>