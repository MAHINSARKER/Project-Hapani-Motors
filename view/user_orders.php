<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>হাপানি মটরস</title>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">   
   <link rel="stylesheet" href="../view/css/css.css"> 
   <link rel="shortcut icon" href="../view/Images/favicon.ico">
</head>
<body>
   
   <header> 
      <?php include 'user_profile_header.php'; ?>
   </header>

   <section class="placed-orders">

      <h1 class="title">My Orders</h1>

      <div class="box-container">

      <?php
         if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
         <p> Order Date : <span><?= htmlspecialchars($fetch_orders['date']); ?></span> </p>
         <p> Name : <span><?= htmlspecialchars($fetch_orders['name']); ?></span> </p>
         <p> Number : <span><?= htmlspecialchars($fetch_orders['number']); ?></span> </p>
         <p> Email : <span><?= htmlspecialchars($fetch_orders['email']); ?></span> </p>
         <p> Address : <span><?= htmlspecialchars($fetch_orders['address']); ?></span> </p>
         <p> Payment Method : <span><?= htmlspecialchars($fetch_orders['method']); ?></span> </p>
         <p> Your Orders : <span><?= htmlspecialchars($fetch_orders['total_products']); ?></span> </p>
         <p> Total Price : <span>$<?= htmlspecialchars($fetch_orders['total_price']); ?></span> </p>
         <p> Order Delivery Status : <span style="color:<?php if($fetch_orders['comment'] == 'Pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= htmlspecialchars($fetch_orders['comment']); ?></span> </p>
      </div>
      <?php
         }
      }
      
      else{
         echo '<p class="empty">No orders placed yet!</p>';
      }
      ?>

      </div>

   </section>

   <?php include 'user_footer.php'; ?>

</body>
</html>