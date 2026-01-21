<?php

session_start();
include '../model/admin_product.php';


if(!isset($_SESSION['user_id'])){
    header('location: Admin_LoginController.php');
    exit;
}

$message = [];

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $category = $_POST['category'];

    $target_dir = "../view/uploaded_img/";
    
    // Create folder if not exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    //image upload
    $image_name = basename($_FILES["pic"]["name"]);
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is actual image
    $check = getimagesize($_FILES["pic"]["tmp_name"]);
    if($check === false) {
        $message[] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $message[] = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (2MB limit)
    if ($_FILES["pic"]["size"] > 2000000) {
        $message[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "webp") {
        $message[] = "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // Error message already set above
    } else {
        // Try to upload file
        if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            
            // --- CALL MODEL TO INSERT ---
            $result = addProduct($name, $category, $desc, $price, $image_name);

            if($result === true){
                $message[] = "Product added successfully!";
            } else {
                $message[] = "DB Error: " . $result;
            }

        } 
        else {
            $message[] = "Sorry, there was an error uploading your file.";
        }
    }
}

// --- DELETE PRODUCT LOGIC --
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    
    $deleted_image_name = deleteProduct($delete_id);
    
    if($deleted_image_name){
        // Delete the physical file
        $file_path = "../view/uploaded_img/" . $deleted_image_name;
        if(file_exists($file_path)){
            unlink($file_path);
        }
        $message[] = "Product deleted successfully!";
        // Redirect to clear the $_GET parameter
        header('location: Admin_ProductController.php'); 
        exit;
    } 
    else {
        $message[] = "Failed to delete product.";
    }
}

$products_list = getAllProducts();

include '../view/admin_product.php';
?>