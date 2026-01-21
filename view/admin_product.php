<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>হাপানি মটরস - Manage Products</title>     
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="../view/css/css.css">
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php include 'admin_header.php'; ?>  

<section class="add_product">
    <p class="title">Add New Product</p>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Product Name</label>
        <input type="text" name="name" class="p_box" required>

        <label>Select Category</label>
        <select name="category" class="p_box" required>
            <option value="rickshaw">Rickshaw</option>
            <option value="tesla">Bangla Tesla</option>
        </select>

        <label>Price</label>
        <input type="number" min="0" name="price" class="p_box" required>

        <label>Product Image</label>
        <input type="file" name="pic" class="p_box" required>

        <label>Description</label>
        <textarea name="desc" class="p_box" required></textarea>

        <input type="submit" name="add_product" class="add-btn" value="Add Product">
    </form>
</section>

<section class="show_products">
    <p class="title">Products Added</p>
    <div class="box-container">
    
    <?php
      if(!empty($products_list)){
         foreach($products_list as $fetch_products){  
    ?>
    
    <div class="box" id="product_box_<?= $fetch_products['product_id']; ?>">
       <div class="price">$<?= htmlspecialchars($fetch_products['price']); ?></div>
       
       <img src="../view/uploaded_img/<?= htmlspecialchars($fetch_products['image']); ?>" alt="">
       
       <div class="name"><?= htmlspecialchars($fetch_products['name']); ?></div>
       <div class="category"><?= htmlspecialchars($fetch_products['category']); ?></div>
       <div class="details"><?= htmlspecialchars($fetch_products['details']); ?></div>
       
       <div class="flex-btn">
          <a href="Admin_ProductUpdateController.php?update=<?= $fetch_products['product_id']; ?>" class="option-btn">Update</a>
          
          <a href="#" onclick="deleteProductAJAX(<?= $fetch_products['product_id']; ?>)" class="delete-btn">Delete</a>
       </div>
    </div>

    <?php
         }
      }
      else{
         echo '<p class="empty">No products added yet!</p>';
      }
    ?>
    </div>
</section>

<?php if(!empty($message)): ?>
<script>
    Swal.fire({
        text: "<?php echo implode('\n', $message); ?>",
        icon: "info"
    });
</script>
<?php endif; ?>

<script>
function deleteProductAJAX(id) {
    Swal.fire({
        title: 'Delete this product?',
        text: "It will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'black',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                if(this.responseText.trim() == "success"){
               
                    Swal.fire("Deleted!", "Product has been deleted.", "success");
                    

                    const box = document.getElementById("product_box_" + id);
                    if(box) {
                        box.style.display = "none";
                    }
                } else {
                    Swal.fire("Error!", "Failed to delete product.", "error");
                }
            }
            
            xhttp.open("POST", "../controller/Admin_AjaxController.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhttp.send("action=delete_product&id=" + id);

        }
    })
}
</script>

</body>
</html>