<?php

function getAllProducts() {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $query= "SELECT * FROM product";
    $result= mysqli_query($conn, $query);
    
    $products= [];
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $products[] = $row;
        }
    }
    return $products;
}

function addProduct($name, $category, $desc, $price, $image) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    
    $name = mysqli_real_escape_string($conn, $name);
    $category = mysqli_real_escape_string($conn, $category);
    $desc = mysqli_real_escape_string($conn, $desc);
    $price = mysqli_real_escape_string($conn, $price);
    $image = mysqli_real_escape_string($conn, $image);

    $sql= "INSERT INTO product (name, category, details, price, image) VALUES ('$name', '$category', '$desc', '$price', '$image')";
    
    if(mysqli_query($conn, $sql)){
        return true;
    } 
    
    else {
        return mysqli_error($conn);
    }
}

function deleteProduct($id) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    
   
    if (!$conn) { return "Connection Failed: " . mysqli_connect_error(); }

    $id = mysqli_real_escape_string($conn, $id);

  
    $fetch = mysqli_query($conn, "SELECT image FROM product WHERE product_id = '$id'");
    if(mysqli_num_rows($fetch) == 0) {
        return "Product ID not found in Database"; 
    }
    $row = mysqli_fetch_assoc($fetch);
    $image_name = $row['image'];


    mysqli_query($conn, "DELETE FROM cart WHERE pid = '$id'"); 
    mysqli_query($conn, "DELETE FROM wishlist WHERE pid = '$id'");


    $delete = mysqli_query($conn, "DELETE FROM product WHERE product_id = '$id'");

    if($delete){
        return $image_name; 
    } else {
        return "SQL Error: " . mysqli_error($conn); 
}
}

function getProductById($id) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $id= mysqli_real_escape_string($conn, $id);
    
    $query= "SELECT * FROM product WHERE product_id = '$id'";
    $result= mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function updateProductInfo($id, $name, $category, $details, $price) {
    $conn= mysqli_connect("localhost", "root", "", "hapani");
    $id= mysqli_real_escape_string($conn, $id);
    $name= mysqli_real_escape_string($conn, $name);
    $category= mysqli_real_escape_string($conn, $category);
    $details= mysqli_real_escape_string($conn, $details);
    $price= mysqli_real_escape_string($conn, $price);

    $sql= "UPDATE product SET name = '$name', category = '$category', details = '$details', price = '$price' WHERE product_id = '$id'";
    
    if(mysqli_query($conn, $sql)){
        return true;
    } 
    
    else {
        return mysqli_error($conn);
    }
}

function updateProductImage($id, $image_name) {
    $conn = mysqli_connect("localhost", "root", "", "hapani");
    $id = mysqli_real_escape_string($conn, $id);
    $image_name = mysqli_real_escape_string($conn, $image_name);    
    $sql = "UPDATE product SET image = '$image_name' WHERE product_id = '$id'";
    return mysqli_query($conn, $sql);
}

?>