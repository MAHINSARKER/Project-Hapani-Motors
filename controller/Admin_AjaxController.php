<?php
include '../model/admin_user.php'; 
include '../model/admin_dashboard.php';
include '../model/admin_product.php';


if(isset($_GET['action']) && $_GET['action'] == 'search_employee'){
    $q = $_GET['q'];
    $staff = getSupportStaff($q);
    
    if(!empty($staff)){
        foreach($staff as $row){
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['number']}</td>
                    <td>{$row['address']}</td>
                    <td><a href='#' class='delete-link'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No staff found</td></tr>";
    }
    exit;
}


if(isset($_GET['action']) && $_GET['action'] == 'get_stats'){
    $rev = getTotalRevenue();
    $orders = getTotalOrdersCount();

    echo json_encode(['revenue' => $rev, 'orders' => $orders]);
    exit;
}



if(isset($_POST['action']) && $_POST['action'] == 'delete_product'){
    $id = $_POST['id'];
    
    // Call the model
    $result = deleteProduct($id); 
    
    // Check if result is a valid image name (mostly ends in .jpg, .png, .jpeg)
    // Or if it's not an error message string
    if(strpos($result, 'Error') === false && strpos($result, 'not found') === false){
        
        $file_path = "../view/uploaded_img/" . $result;
        
        if(file_exists($file_path)){
            unlink($file_path);
        }
        echo "success";
    } else {
        // Echo the ACTUAL error message from the model
        echo "Failed: " . $result;
    }
    exit;
}
?>