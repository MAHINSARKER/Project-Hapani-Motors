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
    
    <?php include 'user_header.php'; ?>

    <div class="user_login">
        <form action="" method="POST" onsubmit="return validateLogin()">
            <p>Login</p>
            <input type="email" name="email" id="email" placeholder="Enter Your Email" class="box" required>
            <input type="password" name="password" id="password" placeholder="Enter Your Password" class="box" required>
            
            <input type="submit" name="submit" value="Login" class="login_button">
            <p class="login-link" style="text-align: center; font-size: 1.2rem; margin-top: 15px;">
                <a href="../view/forgot_password.php">Forgot Password?</a>
            </p>
            
            <p style="font-size: 1.1rem; margin-top: 1.5rem;">
                Don't Have an Account? <a href="../controller/RegisterController.php">Create One!</a>
            </p>
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
                heightAuto: false, 
                scrollbarPadding: false 
            }).then(() => {
                window.location.href = "<?php echo $redirect_url; ?>";
            });
        </script>
    <?php endif; ?>

    <?php if($warning_msg != ""): ?>
        <script>
            Swal.fire({
                icon: "warning",
                title: "Oops...",
                text: "<?php echo $warning_msg; ?>",
                heightAuto: false,
                scrollbarPadding: false
            });
        </script>
    <?php endif; ?>

    <?php include 'user_footer.php' ?>

</body>
</html>