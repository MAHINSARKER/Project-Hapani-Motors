<?php
session_start();
require_once('../model/user.php');

$warning_msg = "";
$success_msg = "";

if (isset($_POST['reset_password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if (empty($email) || empty($new_pass)) {
        $warning_msg = "Please fill in all fields!";
    } elseif ($new_pass !== $confirm_pass) {
        $warning_msg = "Passwords do not match!";
    } else {
    
        $result = resetUserPassword($email, $new_pass);

        if ($result === true) {
            $success_msg = "Password reset successfully! You can now login.";
        } else {
            $warning_msg = $result; 
        }
    }
}

include '../view/forgot_password.php';
?>