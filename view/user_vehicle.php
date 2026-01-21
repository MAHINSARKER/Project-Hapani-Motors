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
    
    <style>

        .filter-container { text-align: center; margin-bottom: 2rem; margin-top: 1rem; }
        .filter-btn {
            background-color: white; border: 2px solid black; padding: 10px 20px;
            margin: 0 5px; cursor: pointer; font-size: 16px; transition: 0.3s; border-radius: 5px;
        }
        .filter-btn:hover, .filter-btn:focus { background-color: black; color: white; }
    </style>
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

    <section class="products">
        <p class="v_title">Latest Products</p>
        
        <div class="filter-container">
            <button class="filter-btn" onclick="filterProducts('all')">All</button>
            <button class="filter-btn" onclick="filterProducts('rickshaw')">Rickshaw</button>
            <button class="filter-btn" onclick="filterProducts('tesla')">Bangla Tesla</button>
        </div>

        <div class="box-container" id="product_container">
  
            <?php
            if(!empty($products)){
                foreach ($products as $fetch_products) {
            ?>
                <div class="v_box">
                    <div class="price">
                        $<span><?= htmlspecialchars($fetch_products['price']); ?></span>
                    </div>                        
                    <img src="../view/uploaded_img/<?= htmlspecialchars($fetch_products['image']); ?>" alt="">                        
                    <div class="name"><?= htmlspecialchars($fetch_products['name']); ?></div>                        
                    
                    <input type="number" min="1" value="1" id="qty_<?= $fetch_products['product_id']; ?>" class="qty">                        
                    
                    <button type="button" class="btn" onclick="addToCartAJAX(
                        <?= $fetch_products['product_id']; ?>, 
                        '<?= $fetch_products['name']; ?>', 
                        <?= $fetch_products['price']; ?>, 
                        '<?= $fetch_products['image']; ?>'
                    )">Add to Cart</button>

                    <a href="../controller/ViewProductController.php?pid=<?= htmlspecialchars($fetch_products['product_id']); ?>" class="btn-alt"> View Product</a>
                </div>
            <?php
                }
            } 
            else{
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>
        
        </div>
    </section>
    
    <a href="../controller/CheckoutController.php" class="btn" style="margin: 2rem auto; display:block; width: fit-content;">View Cart</a>
    
    <?php include 'user_footer.php'; ?>

    <script>
    // --- 1. FILTER FUNCTION ---
    function filterProducts(category) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("product_container").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../controller/AjaxUserController.php?action=filter_category&category=" + category);
        xhttp.send();
    }

    // --- 2. ADD TO CART FUNCTION ---
    function addToCartAJAX(pid, name, price, image) {
        // Get quantity from the specific input field
        var qtyInput = document.getElementById("qty_" + pid);
        var qty = qtyInput ? qtyInput.value : 1;

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var response = this.responseText.trim();
            
            if(response == "success"){
                Swal.fire({
                    icon: 'success', title: 'Added!', text: 'Product added to cart.',
                    timer: 1500, showConfirmButton: false
                });
            } else if(response == "exists"){
                Swal.fire({
                    icon: 'info', title: 'Cart', text: 'Product already in cart!'
                });
            } else if(response == "login_required"){
                Swal.fire({
                    icon: 'warning', title: 'Login Required', text: 'Please login to shop!',
                    confirmButtonText: 'Login'
                }).then((result) => {
                    if (result.isConfirmed) { window.location.href = "UserAuthController.php"; }
                });
            } else {
                Swal.fire("Error", "Failed: " + response, "error");
            }
        }
        
        xhttp.open("POST", "../controller/AjaxUserController.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action=add_to_cart&pid=" + pid + "&name=" + name + "&price=" + price + "&image=" + image + "&qty=" + qty);
    }
    </script>

    <?php if(isset($success_msg) && $success_msg != ""): ?>
        <script>
            Swal.fire({
                icon: "success", title: "Success!", text: "<?php echo $success_msg; ?>", 
                showConfirmButton: false, timer: 1500
            });
        </script>
    <?php endif; ?>

    <?php if(isset($warning_msg) && $warning_msg != ""): ?>
        <script>
            Swal.fire({
                icon: "warning", title: "Oops...", text: "<?php echo $warning_msg; ?>"
            });
        </script>
    <?php endif; ?>

</body>
</html>