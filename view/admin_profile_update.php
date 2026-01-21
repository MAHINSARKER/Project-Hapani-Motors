<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>হাপানি মটরস</title>  
    <link rel="stylesheet" href="../view/css/css.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php include 'admin_header.php'; ?>

    <section class="update_profile">
        <div class="update_form">
            <p class="title">Update Admin Profile</p>

            <form action="" method="POST">
                <label>Name</label>
                <input type="text" name="name" value="<?= isset($fetch_profile['name']) ? $fetch_profile['name'] : ''; ?>" class="box">
                
                <label>Email</label>
                <input type="email" name="email" value="<?= isset($fetch_profile['email']) ? $fetch_profile['email'] : ''; ?>" class="box">
                
                <label>Phone Number</label>
                <input type="text" name="number" value="<?= isset($fetch_profile['number']) ? $fetch_profile['number'] : ''; ?>" class="box">
                
                <label>Address</label>
                <input type="text" name="address" value="<?= isset($fetch_profile['address']) ? $fetch_profile['address'] : ''; ?>" class="box">
                
                <label>Password</label>
                <input type="text" name="password" value="<?= isset($fetch_profile['password']) ? $fetch_profile['password'] : ''; ?>" class="box">
                
                <input type="submit" name="update" value="Update Profile" class="btn">
            </form>
        </div>
    </section>

    <?php if (!empty($success_msg)) : ?>
        <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "<?=$success_msg ?>",
            showConfirmButton: false,
            timer: 2000,
            heightAuto: false
        }).then(() => {
            window.location.href = "Admin_LoginController.php";
        });
        </script>
    <?php endif; ?>

    <?php if (!empty($warning_msg)) : ?>
        <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "<?=$warning_msg ?>",
            heightAuto: false
        });
        </script>
    <?php endif; ?>

</body>
</html>