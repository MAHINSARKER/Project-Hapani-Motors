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
    <link rel="stylesheet" href="../view/css/css.css">
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
</head>
<body>
    
    <header> 
      <?php
      if(!isset($_SESSION['user_id'])){ 
          include 'user_header.php';
      } else {
          include 'user_profile_header.php';
      }
      ?>
    </header>
    <div class="checkout_container">

        <section class="display-orders">
            <?php
                $cart_grand_total = 0;
                if(mysqli_num_rows($select_cart_items) > 0){
                    while($fetch_cart_items = mysqli_fetch_assoc($select_cart_items)){
                        $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
                        $cart_grand_total += $cart_total_price;
            ?>
            <p> <?= $fetch_cart_items['name']; ?> <span>($<?= $fetch_cart_items['price']; ?> x <?= $fetch_cart_items['quantity']; ?>)</span> </p>
            <?php
                    }
                }else{
                    echo '<p class="empty">Your cart is Empty!</p>';
                }
            ?>
            <div class="grand-total">Grand total : <span>$<?= $cart_grand_total; ?></span></div>
        </section>

        <section class="checkout-form">
            <form action="" method='POST'>
                <p class="checkout_title">Place Your Order</p>
                <div class="flex">
                    <div class="inputBox">
                        <input type="text" name="name" placeholder="Enter Recipient Name" class="box" required>
                    </div>
                    <div class="inputBox">
                        <input type="number" name="number" placeholder="Enter Recipient Mobile Number" class="box" required>
                    </div>
                    <div class="inputBox">
                        <input type="email" name="email" placeholder="Enter Email Address" class="box" required>
                    </div>
                    <div class="inputBox">
                        <select name="method" class="box" required>
                            <option value="" disabled selected>Payment Method</option>                        
                            <option value="cash_on_delivery">Cash on Delivery</option>
                            <option value="credit card">Credit Card</option>
                            <option value="bkash">Bkash</option>
                            <option value="nagad">Nagad</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <input type="text" name="address" placeholder="Enter Delivery Address" class="box" required>
                    </div>
                </div>
                
                <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="Place Order Now!">
            </form>
        </section>

    </div>

    <?php include 'user_footer.php'; ?>

    <?php if($success_msg != ""): ?>
    <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "<?php echo $success_msg; ?>",
            showConfirmButton: true
        });
    </script>
    <?php endif; ?>

    <?php if($warning_msg != ""): ?>
    <script>
        Swal.fire({
            icon: "warning",
            title: "Warning",
            text: "<?php echo $warning_msg; ?>",
            showConfirmButton: true
        });
    </script>
    <?php endif; ?>

</body>
</html>