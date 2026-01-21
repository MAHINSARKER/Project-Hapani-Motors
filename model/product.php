<?php

function getAllProducts(){

    $conn= mysqli_connect("localhost", "root", "", "hapani");
    if(!$conn){ 
        die("Connection failed: " . mysqli_connect_error()); 
        
    }

    $sql= "SELECT * FROM `product`";
    $result= mysqli_query($conn, $sql);

    $products= array();
    while ($row= mysqli_fetch_assoc($result)) {
        $products[]= $row;
    }

    mysqli_close($conn);
    return $products;
}

function getProductById($pid){
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $pid= mysqli_real_escape_string($conn, $pid);
    $sql= "SELECT * FROM product WHERE product_id = '$pid'";
    $result= mysqli_query($conn, $sql);
    $product= null;
    if(mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    }
    
    mysqli_close($conn);
    return $product;
}
?>
