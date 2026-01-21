<?php

function sendContactMessage($name, $email, $number, $message){
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    if(!$conn) 
        { die("Connection failed: " . mysqli_connect_error()); 
    }

    $name= mysqli_real_escape_string($conn, $name);
    $email= mysqli_real_escape_string($conn, $email);
    $number= mysqli_real_escape_string($conn, $number);
    $message= mysqli_real_escape_string($conn, $message);

    $sql= "INSERT INTO contact (name, email, number, message) VALUES ('$name', '$email', '$number', '$message')";
    $result= mysqli_query($conn, $sql);

    mysqli_close($conn);
    
    return $result;
}
?>