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

    <?php include 'admin_header.php'; ?>

    <section class="update-product">
        <h1 class="title">Update Product</h1>

        <?php if($product): ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="old_image" value="<?= $product['image']; ?>">
            <input type="hidden" name="pid" value="<?= $product['product_id']; ?>">
            
            <label>Product Name</label>
            <input type="text" name="name" class="box" required value="<?= $product['name']; ?>">
            
            <label>Product Price</label>
            <input type="number" name="price" class="box" min="0" required value="<?= $product['price']; ?>">

            <label>Category</label>
            <select name="category" class="box" required>
                <option value="<?= $product['category']; ?>" selected></option>
                <option value="rickshaw">Rickshaw</option>
                <option value="tesla">Bangla Tesla</option>
            </select>

            <label>Description</label>
            <textarea name="details" class="box" required><?= $product['details']; ?></textarea>

            <label>Update Image (Optional)</label>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">

            <div class="flex-btn">
                <input type="submit" class="btn" name="update_product" value="Update Product">
                <a href="Admin_ProductController.php" class="option-btn">Go Back</a>
            </div>
        </form>
        
        <?php else: ?>
            <p class="empty">No product found!</p>
            <a href="Admin_ProductController.php" class="option-btn">Go Back to Products</a>
        <?php endif; ?>
        
    </section>

    <?php if(!empty($message)): ?>
    <script>
        Swal.fire({
            text: "<?php echo implode('\n', $message); ?>",
            icon: "info",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    <?php endif; ?>

</body>
</html>