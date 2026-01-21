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
        .form-container { min-height: 100vh; display: flex; align-items: center; justify-content: center; background-color: white; }
        .form-container form { width: 500px; background-color: white; border-radius: 5px; padding: 2rem; text-align: center; }
        .form-container form h3 { font-size: 2.5rem; color: black; margin-bottom: 1rem; }
        .form-container form .box { width: 100%; padding: 12px 14px; background-color: white; font-size: 1.6rem; color: black; margin: 10px 0; border: 1px solid black; border-radius: 0.5rem; }
        .form-container form .btn { display: block; width: 100%; margin-top: 10px; background-color: black; color: white; padding: 10px; font-size: 1.8rem; cursor: pointer; border-radius: 0.5rem; }
        .form-container form .btn:hover { background-color: black; }
        .form-container form p { margin-top: 1.5rem; font-size: 1.5rem; color: grey; }
        .form-container form p a { color: black; }
        .form-container form p a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<?php include 'user_header.php' ?>
<section class="form-container">

    <form action="" method="post" id="resetForm">
        <h3>Reset Password</h3>
        
        <input type="email" id="email" required placeholder="Enter your registered email" class="box" require>
        
        <input type="password" id="pass" required placeholder="Enter new password" class="box" require>
        <input type="password" id="cpass" required placeholder="Confirm new password" class="box" require>
        
        <button type="button" class="btn" onclick="resetPasswordAJAX()">Reset Password</button>
        
        <p>Remembered your password? <a href="../controller/LoginController.php">Login now</a></p>
    </form>

</section>
<?php include 'user_footer.php'; ?>

<script>
function resetPasswordAJAX() {
    var email = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;
    var cpass = document.getElementById("cpass").value;

    // 1. Client-side Validation
    if(email == "" || pass == "" || cpass == ""){
        Swal.fire("Error", "Please fill all fields!", "error");
        return;
    }
    
    if(pass != cpass){
        Swal.fire("Error", "Confirm password does not match!", "error");
        return;
    }

    // 2. AJAX Request
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var response = this.responseText.trim();
        
        if(response == "success"){
            Swal.fire({
                icon: 'success',
                title: 'Password Updated!',
                text: 'You can now login with your new password.',
                showConfirmButton: true,
                confirmButtonText: 'Go to Login'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../controller/LoginController.php";
                }
            });
        } else if(response == "email_not_found"){
            Swal.fire("Error", "This email is not registered!", "error");
        } else {
            Swal.fire("Error", "Something went wrong. Try again.", "error");
        }
    }
    
    xhttp.open("POST", "../controller/AjaxUserController.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=reset_password&email=" + email + "&pass=" + pass);
}
</script>

</body>
</html>