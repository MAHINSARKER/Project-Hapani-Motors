<?php

session_start();
include '../model/support_model.php';

$success_msg = "";
$error_msg = "";

$messages_list = getAllMessages();

// 4. Load View
include '../view/support_message.php';
?>