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
      if(!isset($_SESSION['user_id'])){ 
          include 'user_header.php';
      } 
      else{
          include 'user_profile_header.php'; 
      }
      ?>
    </header>
    
    <section class="contact">
       
        <form action="" method="POST">
            <p class="c_title">Get in Touch</p>
            <input type="text" name="name" class="user_cbox" placeholder="Enter Your Name" required>
            <input type="email" name="email" class="user_cbox" placeholder="Enter Your Email" required>
            <input type="number" name="number" class="user_cbox" min="0" placeholder="Enter Your Number" required>
            <textarea name="msg" class="msg" placeholder="Enter Your Message" cols="30" rows="10" required></textarea>
            
            <input type="submit" name="send" value="Send Message" class="login_button">
        </form>
    </section>

    <?php include 'user_footer.php'; ?>

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
            })
            .then(() => {
                <?php if($redirect_url != ""): ?>
                    window.location.href = "<?php echo $redirect_url; ?>";
                <?php endif; ?>
            });
        </script>
    <?php endif; ?>

</body>
</html>