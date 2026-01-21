<?php

session_start();
include '../model/contact.php';

$success_msg= "";
$warning_msg= "";
$redirect_url= ""; 

if(isset($_POST['send'])){
    $c_name= $_POST['name'];
    $c_email= $_POST['email'];
    $c_number= $_POST['number'];
    $c_message= $_POST['msg'];
        
    if(sendContactMessage($c_name, $c_email, $c_number, $c_message)){
            $success_msg= "Message Sent Successfully!";
        } 
        else{
            $warning_msg= "Something went wrong. Please try again.";
        }
    }


include '../view/user_contact.php';
?>