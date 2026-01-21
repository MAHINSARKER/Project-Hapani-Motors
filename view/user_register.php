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
    <script src="../view/js/validation.js"></script>
</head>
<body>

    <?php include 'user_header.php'; ?>

    <div class="register_container">
        <div class="register_form">
            <form action="" method="POST" onsubmit="return validateRegistration()">
                <p>Register Now</p> 
                <input type="text" name="name" placeholder="Enter Your Name" class="box" required>
                
                <input type="email" name="email" id="reg_email" placeholder="Enter Your Email" class="box" required onblur="checkEmailAvailability()">
                
                <span id="email_status_msg" style="font-size: 14px; display: block; margin-top: -5px; margin-bottom: 10px; text-align: left;"></span>

                <input type="password" name="password" placeholder="Enter Your Password" class="box" required>
                <input type="number" name="number" placeholder="Enter Mobile Number" class="box" required>
                <input type="text" name="address" placeholder="Enter Your Address" class="box" required>
                
                <input type="submit" name="submit" value="Register Now" class="register_button">
                
                <p class="login-link">Already have an account? <a href="../controller/LoginController.php">Sign In</a></p>
            </form>
        </div>
    </div>

    <script>
    function checkEmailAvailability() {
        var email = document.getElementById("reg_email").value;
        var statusSpan = document.getElementById("email_status_msg");
        
        // Only check if user has typed something
        if(email.length > 0) {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                // Check response from AjaxUserController
                if(this.responseText.trim() == "taken"){
                    statusSpan.style.color = "red";
                    statusSpan.innerText = "❌ This email is already registered!";
                } else {
                    statusSpan.style.color = "green";
                    statusSpan.innerText = "✔ Email is available.";
                }
            }
            // Ensure this path matches your folder structure
            xhttp.open("GET", "../controller/AjaxUserController.php?action=check_email&email=" + email);
            xhttp.send();
        } else {
            // Clear message if input is empty
            statusSpan.innerText = "";
        }
    }
    </script>

    <?php if($success_msg != ""): ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "<?php echo $success_msg; ?>",
                showConfirmButton: false,
                timer: 2000,
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
                icon: "error",
                title: "Oops...",
                text: "<?php echo $warning_msg; ?>",
                heightAuto: false,
                scrollbarPadding: false
            });
        </script>
    <?php endif; ?>

    <?php include 'user_footer.php'; ?>
 
</body>
</html>