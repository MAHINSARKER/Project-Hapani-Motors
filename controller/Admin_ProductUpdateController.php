<?php

session_start();
include '../model/admin_product.php';

if(!isset($_SESSION['user_id'])){
    header('location: Admin_LoginController.php');
    exit;
}
$message= [];
$product= null;

if(isset($_GET['update'])){
    $update_id= $_GET['update'];
    $product= getProductById($update_id);

    if(!$product){
        $message[]= "Product not found!";
    }
} 
else {
    $message[]= "No product selected!";
}

if(isset($_POST['update_product'])){
    $pid= $_POST['pid'];
    $name= $_POST['name'];
    $price= $_POST['price'];
    $category= $_POST['category'];
    $details= $_POST['details'];
    $old_image= $_POST['old_image'];

    $update_result= updateProductInfo($pid, $name, $category, $details, $price);
    
    if($update_result === true) {
        $message[]= "Product info updated successfully!";
        
        $product = getProductById($pid);
    } else {
        $message[] = "Update failed: " . $update_result;
    }

    // Handle Image Update (If new file selected)
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        
        $image_name= $_FILES['image']['name'];
        $image_tmp= $_FILES['image']['tmp_name'];
        $image_size= $_FILES['image']['size'];
        
        $target_dir= "../view/uploaded_img/";
        $target_file= $target_dir . basename($image_name);
        
        if($image_size > 2000000){
            $message[] = "Image size is too large (Max 2MB)";
        } 
        
        else {
             updateProductImage($pid, $image_name);
            
            
            if(move_uploaded_file($image_tmp, $target_file)){
                
                $old_image_path = $target_dir . $old_image;
                if(file_exists($old_image_path)){
                    unlink($old_image_path);
                }
                
                $message[] = "Image updated successfully!";
                $product = getProductById($pid);
                
            } 
            
            else {
                $message[] = "Failed to upload new image folder.";
            }
        }
    }
}

include '../view/admin_product_update.php';
?>