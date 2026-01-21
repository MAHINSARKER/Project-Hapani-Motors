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
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
    <link rel="stylesheet" href="../view/css/css.css">
</head>
<body>

    <header>
        <?php 
        if(isset($_SESSION['user_id']))
            { 
                include 'user_profile_header.php'; 
                }
                else{ 
                    include 'user_header.php'; 
                    
                    }
        ?>
    </header>

    <section class="view_page">
        
        <h1 class="heading">Vehicle Info</h1>

        <?php if($fetch_product): ?>
            <form action="" method="post" class="product_details_container">
                
                <div class="left_column_image">
                    <img src="../view/uploaded_img/<?= htmlspecialchars($fetch_product['image']); ?>" alt="Vehicle Image">
                </div>

                <div class="right_column_details">
                    <div class="name"><?= htmlspecialchars($fetch_product['name']); ?></div>
                    
                    <div class="price">$<?= htmlspecialchars($fetch_product['price']); ?></div>
                    
                    <div class="details_title">Product Details:</div>
                    <div class="details_text">
                        <?= htmlspecialchars($fetch_product['details']); ?>
                    </div>
                    <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_product['product_id']); ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_product['name']); ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($fetch_product['price']); ?>">
                    <input type="hidden" name="image" value="<?= htmlspecialchars($fetch_product['image']); ?>">
                    <div class="buy_actions">
                        <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty">
                        <input type="submit" name="add_to_cart" value="Add To Cart" class="btn">
                    </div>
                </div>

            </form>
        <?php else: ?>
            <p class="empty">Product not found!</p>
            <a href="VehicleController.php" class="btn" style="margin-top: 2rem;">Go Back</a>
        <?php endif; ?>

    </section>

    <?php include 'user_footer.php'; ?>

    <?php if($success_msg != ""): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?= $success_msg; ?>',
                timer: 1500,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <?php if($warning_msg != ""): ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '<?= $warning_msg; ?>'
            });
        </script>
    <?php endif; ?>

</body>
</html>