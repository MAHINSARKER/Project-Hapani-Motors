<?php

session_start();
require_once '../model/user.php';

$warning_msg= ""; 
$success_msg= "";
$redirect_url= ""; 

if(isset($_POST['submit'])){   
    $email= $_POST['email'];
    $password= $_POST['password'];

    if(empty($email) || empty($password)){
        $warning_msg= "Please fill in all fields!";
    } 

    else{
        $row = verifyUser($email, $password);

        if($row){
            if($row['user_type'] == 'user'){                
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_type'] = 'user';                
                $success_msg = "Login Successful!";
                $redirect_url = "../controller/HomeController.php"; 
                } 
            
            else{
                $warning_msg = "Plese select login as Admin/Customer Support";
                }
                
                } 
        
else{
    $warning_msg = "Incorrect Email or Password!";
    }
    
    }
}

include '../view/user_login.php';
?>