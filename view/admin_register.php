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
    <script src="../view/js/validation.js"></script>
</head>
<body>

    <?php include '../view/user_header.php'; ?>

    <div class="register_container">
        <div class="register_form">
            <form action="" method="POST" onsubmit="return validateRegistration()">
                <p>Register New Admin</p> 
                <input type="text" name="name" placeholder="Enter Name" class="box" required>
                <input type="email" name="email" placeholder="Enter Email" class="box" required>
                <input type="password" name="password" placeholder="Enter Password" class="box" required>
                <input type="number" name="number" placeholder="Enter Mobile Number" class="box" required>
                <input type="text" name="address" placeholder="Enter Address" class="box" required>
                
                <input type="submit" name="submit" value="Register Now" class="register_button">
                
                <p class="login-link">Already have an account? <a href="Admin_LoginController.php">Sign In</a></p>
            </form>
        </div>
    </div>

    <?php if($success_msg != ""): ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "<?php echo $success_msg; ?>",
                showConfirmButton: false,
                timer: 2000,
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
                title: "Oops...",
                text: "<?php echo $warning_msg; ?>",
                heightAuto: false
            });
        </script>
    <?php endif; ?>

    <?php include '../view/user_footer.php'; ?>
 
</body>
</html>