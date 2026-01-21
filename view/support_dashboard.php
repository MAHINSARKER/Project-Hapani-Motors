<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>হাপানি মটরস</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../view/css/css.css"> 
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
</head>
<body>

    <?php include 'support_header.php'; ?>

    <section class="dashboard">
        <h1 class="title">Support Dashboard</h1>

        <p class="support-customer-title">Customer Orders</p>

        <div class="support-table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Products</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($orders_list)){
                        foreach($orders_list as $order){
                       
                            $is_delivered = (strtolower($order['comment']) == 'delivered');
                    ?> 
                    <tr>
                        <td>#<?= $order['order_id']; ?></td>
                        <td><?= $order['name']; ?></td>
                        <td><?= $order['number']; ?></td>
                        <td><?= $order['address']; ?></td>
                        <td><?= $order['total_products']; ?></td>
                        <td>$<?= $order['total_price']; ?></td>
                        <td><?= $order['date']; ?></td>
                        
                        <td style="font-weight: bold; text-transform: uppercase;">
                            <span id="status_text_<?= $order['order_id']; ?>" style="color: <?= $is_delivered ? 'green' : 'red'; ?>;">
                                <?= $order['comment']; ?>
                            </span>
                        </td>
                        
                        <td id="action_cell_<?= $order['order_id']; ?>">
                            <?php if($is_delivered): ?>
                                <span class="status-done">Completed</span>
                            <?php else: ?>
                                <button type="button" onclick="updateOrderStatus(<?= $order['order_id']; ?>)" class="status-btn">Update</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                        }
                    } 
                    else {
                        echo '<tr><td colspan="9" class="empty">No orders found!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </section>

    <script>
    function updateOrderStatus(id) {
        Swal.fire({
            title: 'Mark as Delivered?',
            text: "This will update the order status instantly.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Update!'
        }).then((result) => {
            if (result.isConfirmed) {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if(this.responseText.trim() == "success"){
                        Swal.fire("Updated!", "Order status is now Delivered.", "success");
                        
                        // 1. Update Status Text Color and Content
                        const statusText = document.getElementById("status_text_" + id);
                        if(statusText) {
                            statusText.innerText = "delivered";
                            statusText.style.color = "green";
                        }

                        // 2. Change Button to "Completed" badge
                        const actionCell = document.getElementById("action_cell_" + id);
                        if(actionCell) {
                            actionCell.innerHTML = '<span class="status-done">Completed</span>';
                        }
                        
                    } else {
                        Swal.fire("Error!", this.responseText, "error");
                    }
                }
                
                // Pointing to the Controller we created earlier
                xhttp.open("POST", "../controller/Support_AjaxController.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("action=update_order&order_id=" + id);
            }
        })
    }
    </script>

    <?php if(!empty($success_msg)): ?>
    <script>
        Swal.fire({ icon: "success", title: "Success", text: "<?= $success_msg; ?>", showConfirmButton: false, timer: 1500 });
    </script>
    <?php endif; ?>

    <?php if(!empty($error_msg)): ?>
    <script>
        Swal.fire({ icon: "error", title: "Error", text: "<?= $error_msg; ?>" });
    </script>
    <?php endif; ?>

</body>
</html>