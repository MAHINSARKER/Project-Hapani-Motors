<?php

session_start();
include '../model/support_model.php';


if(isset($_POST['action']) && $_POST['action'] == 'update_order'){
    $id = $_POST['order_id'];
    $result = updateOrderToDelivered($id);
    if($result === true){ echo "success"; } else { echo "Error: " . $result; }
    exit;
}


if(isset($_GET['action']) && $_GET['action'] == 'search_user'){
    $q = $_GET['q'];
    $customers = getCustomers($q);
    if(!empty($customers)){
        foreach($customers as $row){

            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['number']}</td>
                    <td>{$row['address']}</td>
                    <td>
                        <a href='#' onclick='deleteUserAJAX({$row['user_id']})' class='delete-link'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo '<tr><td colspan="5" class="empty">No customers found!</td></tr>';
    }
    exit;
}


if(isset($_POST['action']) && $_POST['action'] == 'delete_user'){
    $id = $_POST['user_id'];    

    $result = deleteCustomer($id);
    
    if($result === true){
        echo "success";
    } else {
        echo "Error: " . $result;
    }
    exit;
}
?>