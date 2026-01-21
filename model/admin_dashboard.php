<?php

function getTotalRevenue() {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    
    $query = "SELECT SUM(total_price) AS total_revenue FROM orders";
    $result = mysqli_query($conn, $query);
    
    $row = mysqli_fetch_assoc($result);
    
    return $row['total_revenue'] ? $row['total_revenue'] : 0;
}

function getTotalOrdersCount() {
    $conn = mysqli_connect("localhost", "root", "", "hapani");    
    $query = "SELECT * FROM orders";
    $result = mysqli_query($conn, $query);    
    return mysqli_num_rows($result);
}