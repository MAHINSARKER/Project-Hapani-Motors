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

    <header> 
      <?php include 'user_profile_header.php'; ?>
    </header>

    <section class="update_profile">
        <div class="update_form">
            <p class="title">Profile</p>

            <form action="" method="POST">
                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?= isset($fetch_profile['name']) ? htmlspecialchars($fetch_profile['name']) : ''; ?>" class="box" required>
                </div>
                
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= isset($fetch_profile['email']) ? htmlspecialchars($fetch_profile['email']) : ''; ?>" class="box" required>
                </div>
                
                <div class="input-group">
                    <label>Phone Number</label>
                    <input type="number" name="number" value="<?= isset($fetch_profile['number']) ? htmlspecialchars($fetch_profile['number']) : ''; ?>" class="box" required>
                </div>
                
                <div class="input-group">
                    <label>Address</label>
                    <input type="text" name="address" value="<?= isset($fetch_profile['address']) ? htmlspecialchars($fetch_profile['address']) : ''; ?>" class="box" required>
                </div>
                
                <div class="input-group">
                    <label>Password</label>
                    <input type="text" name="password" value="<?= isset($fetch_profile['password']) ? htmlspecialchars($fetch_profile['password']) : ''; ?>" class="box" required>
                </div>

                <input type="submit" name="update" value="Update Profile" class="btn">
            </form>
        </div>
    </section>

    <?php include 'user_footer.php'; ?>

    <?php if($success_msg != ""): ?>
        <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "<?=$success_msg ?>",
            showConfirmButton: false,
            timer: 2000,
            heightAuto: false,
            scrollbarPadding: false
        }).then(() => {
            <?php if ($redirect_url != ""): ?>
                window.location.href = "<?=$redirect_url ?>";
            <?php endif; ?>
        });
        </script>
    <?php endif; ?>

    <?php if($warning_msg != ""): ?>
        <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "<?=$warning_msg ?>",
            heightAuto: false,
            scrollbarPadding: false
        });
        </script>
    <?php endif; ?>

</body>
</html>