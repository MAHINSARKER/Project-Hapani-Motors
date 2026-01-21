<?php

session_start();
$conn = mysqli_connect("localhost", "root", "", "hapani");

// --- ACTION 1: CHECK EMAIL AVAILABILITY (For Registration) ---
if(isset($_GET['action']) && $_GET['action'] == 'check_email'){
    $email = mysqli_real_escape_string($conn, $_GET['email']);
    $check = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    
    if(mysqli_num_rows($check) > 0){
        echo "taken";
    } else {
        echo "available";
    }
    exit;
}

// --- ACTION 2: ADD TO CART ---
if(isset($_POST['action']) && $_POST['action'] == 'add_to_cart'){

    if(!isset($_SESSION['user_id'])){
        echo "login_required";
        exit;
    }

    $user_id = $_SESSION['user_id'];
    
    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $qty = mysqli_real_escape_string($conn, $_POST['qty']);

    // Check if already in cart
    $check_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$name' AND user_id = '$user_id'");

    if(mysqli_num_rows($check_cart) > 0){
        echo "exists";
    } else {
        // *** FIX: Changed 'pid' to 'product_id' here ***
        $query = "INSERT INTO cart (user_id, product_id, name, price, quantity, image) VALUES('$user_id', '$pid', '$name', '$price', '$qty', '$image')";
        
        $insert = mysqli_query($conn, $query);
        
        if($insert){
            echo "success";
        } else {
            // Debugging error
            echo "SQL Error: " . mysqli_error($conn); 
        }
    }
    exit;
}

// --- ACTION 3: FILTER CATEGORY (For Vehicle Page) ---
if(isset($_GET['action']) && $_GET['action'] == 'filter_category'){
    $cat = mysqli_real_escape_string($conn, $_GET['category']);
    
    if($cat == 'all'){
        $query = "SELECT * FROM product";
    } else {
        $query = "SELECT * FROM product WHERE category = '$cat'";
    }
    
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
        while($fetch_products = mysqli_fetch_assoc($result)){
            
            // Returns HTML matching 'user_vehicle.php' structure
            echo '
            <div class="v_box">
                <div class="price">$<span>' . $fetch_products['price'] . '</span></div>
                <img src="../view/uploaded_img/' . $fetch_products['image'] . '" alt="">
                <div class="name">' . $fetch_products['name'] . '</div>
                
                <input type="number" min="1" value="1" id="qty_' . $fetch_products['product_id'] . '" class="qty">
                
                <button type="button" class="btn" onclick="addToCartAJAX(
                    ' . $fetch_products['product_id'] . ', 
                    \'' . $fetch_products['name'] . '\', 
                    ' . $fetch_products['price'] . ', 
                    \'' . $fetch_products['image'] . '\'
                )">Add to Cart</button>

                <a href="../controller/ViewProductController.php?pid=' . $fetch_products['product_id'] . '" class="btn-alt"> View Product</a>
            </div>';
        }
    } else {
        echo '<p class="empty" style="width:100%;">No vehicles found in this category!</p>';
    }
    exit;
}

// --- ACTION 4: UPDATE CART QTY ---
if(isset($_POST['action']) && $_POST['action'] == 'update_cart'){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    
    $update = mysqli_query($conn, "UPDATE cart SET quantity = '$qty' WHERE cart_id = '$cart_id'");
    echo $update ? "success" : "error";
    exit;
}

// --- ACTION 5: DELETE SINGLE ITEM ---
if(isset($_POST['action']) && $_POST['action'] == 'delete_cart'){
    $cart_id = $_POST['cart_id'];
    
    $delete = mysqli_query($conn, "DELETE FROM cart WHERE cart_id = '$cart_id'");
    echo $delete ? "success" : "error";
    exit;
}

// --- ACTION 6: DELETE ALL ITEMS ---
if(isset($_POST['action']) && $_POST['action'] == 'delete_all'){
    if(!isset($_SESSION['user_id'])) exit;
    $user_id = $_SESSION['user_id'];
    
    $delete = mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    echo $delete ? "success" : "error";
    exit;
}

// --- ACTION 7: FORGOT PASSWORD (RESET) ---
if(isset($_POST['action']) && $_POST['action'] == 'reset_password'){
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // Using md5() to match typical project standards. 
    // If your login uses password_hash(), remove md5() and use password_hash($pass, PASSWORD_DEFAULT);
    $pass = md5($_POST['pass']); 
    
    // 1. Check if email exists
    $check_email = mysqli_query($conn, "SELECT * FROM `user` WHERE email = '$email'");
    
    if(mysqli_num_rows($check_email) > 0){
        // 2. Update Password
        $update = mysqli_query($conn, "UPDATE `user` SET password = '$pass' WHERE email = '$email'");
        
        if($update){
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "email_not_found";
    }
    exit;
}
?>