<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>হাপানি মটরস</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
    <link rel="stylesheet" href="../view/css/css.css">
</head>
<body>
    <header> 
      <?php
      if(!isset($_SESSION['user_id'])){ 
          include 'user_header.php';
      }
      else{
          include 'user_profile_header.php';
      }
      ?>
    </header>

    <section class="shopping-cart">

       <p class="v_title">Your Shopping Cart</p>

       <div class="box-container">

       <?php
          $grand_total = 0;
          
          if(isset($select_cart) && mysqli_num_rows($select_cart) > 0){
              while($fetch_cart = mysqli_fetch_assoc($select_cart)){ 
       ?>
       <div class="v_box">
          <a href="#" onclick="deleteCartItem(<?= $fetch_cart['cart_id']; ?>)" class="delete">X</a>            
          
          <img src="../view/uploaded_img/<?= $fetch_cart['image']; ?>" alt="">          
          <div class="name"><?= htmlspecialchars($fetch_cart['name']); ?></div>
          <div class="price">$<?= htmlspecialchars($fetch_cart['price']); ?></div>          
          
          <div class="flex-btn">
             <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" id="qty_<?= $fetch_cart['cart_id']; ?>">
             
             <button type="button" onclick="updateCartQty(<?= $fetch_cart['cart_id']; ?>)" class="option-btn">Update</button>
          </div>
          
          <div class="sub-total"> Sub Total : <span><?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>$</span> </div>
       </div>
       <?php
          $grand_total += $sub_total;
              }
          }
          else{
              echo '<p class="empty">Your Cart is Empty</p>';
          }
       ?>
       </div>

       <div class="cart-total">
          <p>Grand Total : <span><?= $grand_total; ?>$</span></p>
          <div class="flex-btn-group">
              <a href="../controller/VehicleController.php" class="option-btn">Continue Shopping</a>
              
              <a href="#" 
                 class="delete-btn <?= ($grand_total > 0)?'':'disabled'; ?>" 
                 onclick="deleteAllCart()">Delete All</a>
                 
              <a href="../controller/CheckoutController.php" 
                 class="btn <?= ($grand_total > 0)?'':'disabled'; ?>">Proceed to Checkout</a>
          </div>
       </div>

    </section>

    <?php include 'user_footer.php'; ?>

    <script>
    // 1. UPDATE QUANTITY
    function updateCartQty(cart_id) {
        var qty = document.getElementById("qty_" + cart_id).value;
        
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if(this.responseText.trim() == "success"){
                Swal.fire({
                    icon: 'success', title: 'Updated!', text: 'Cart updated successfully',
                    timer: 1000, showConfirmButton: false
                }).then(() => {
                    location.reload(); // Reload to recalculate totals
                });
            } else {
                Swal.fire("Error", "Update failed", "error");
            }
        }
        xhttp.open("POST", "../controller/AjaxUserController.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action=update_cart&cart_id=" + cart_id + "&qty=" + qty);
    }

    // 2. DELETE SINGLE ITEM
    function deleteCartItem(cart_id) {
        Swal.fire({
            title: 'Remove Item?', text: "Do you really want to remove this?",
            icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#d33', confirmButtonText: 'Yes, Remove!'
        }).then((result) => {
            if (result.isConfirmed) {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if(this.responseText.trim() == "success"){
                        location.reload(); 
                    } else {
                        Swal.fire("Error", "Delete failed", "error");
                    }
                }
                xhttp.open("POST", "../controller/AjaxUserController.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("action=delete_cart&cart_id=" + cart_id);
            }
        })
    }

    // 3. DELETE ALL ITEMS
    function deleteAllCart() {
        // Prevent click if disabled
        if(document.querySelector('.delete-btn').classList.contains('disabled')) return;

        Swal.fire({
            title: 'Clear Cart?', text: "This will remove all items!",
            icon: 'warning', showCancelButton: true,
            confirmButtonColor: '#d33', confirmButtonText: 'Yes, Clear All!'
        }).then((result) => {
            if (result.isConfirmed) {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if(this.responseText.trim() == "success"){
                        Swal.fire({
                            icon: 'success', title: 'Cleared!',
                            timer: 1000, showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error", "Failed to clear cart", "error");
                    }
                }
                xhttp.open("POST", "../controller/AjaxUserController.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("action=delete_all");
            }
        })
    }
    </script>

    <?php if(isset($success_msg) && $success_msg != ""): ?>
    <script>
        Swal.fire({
            icon: "success", title: "Success", text: "<?= $success_msg; ?>",
            showConfirmButton: false, timer: 1500
        });
    </script>
    <?php endif; ?>

</body>
</html>