<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>হাপানি মটরস</title>    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">     
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
    <link rel="stylesheet" href="../view/css/css.css">    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../view/js/validation.js"></script>

</head>
<body>
    <?php include '../view/user_header.php'; ?>
    <div class="admin_login">
        <form action="" method="POST" onsubmit="return validateLogin()">
            <p>Admin / Support Login</p>
            <input type="email" name="email" id="email" placeholder="Enter Email" class="box" required>
            <input type="password" name="password" id="password" placeholder="Enter Password" class="box" required>            
            <input type="submit" name="submit" value="Login" class="login_button">
            <p style="text-align: center; margin-top: 15px; font-size: 1.2rem;">
            <a href="ForgotPasswordController.php" style="color: black;">Forgot Password?</a></p>
            
            <div class="admin-links">
                <p class="reg">Register as <a href="AdminRegisterController.php">Admin</a> / <a href="Support_RegisterController.php">Support</a></p>
            </div>
        </form>
    </div>

    <?php if($success_msg != ""): ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "<?php echo $success_msg; ?>",
                showConfirmButton: false,
                timer: 1500,
                heightAuto: false
            }).then(() => {
                window.location.href = "<?php echo $redirect_url; ?>";
            });
        </script>
    <?php endif; ?>

    <?php if($warning_msg != ""): ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Access Error",
                text: "<?php echo $warning_msg; ?>",
                heightAuto: false
            });
        </script>
    <?php endif; ?>


    <?php include 'user_footer.php'; ?>

</body>
</html>