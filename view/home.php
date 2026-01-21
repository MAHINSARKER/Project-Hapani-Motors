<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>হাপানি মটরস</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">    
    <link rel="shortcut icon" href="Images/favicon.ico">
    <link rel="stylesheet" href="css\css.css">

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
    
    <h1 class="vd_h">The vehicle of tomorrow, <br>In your hands today</h1>    
    <video class="video" autoplay muted loop playsinline>
        <source src="Images/v.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <section class="home_category">
        <p class="category_title">What We Sell!</p>
        
        <div class="category-box-container">
            <div class="box">
                <img src="Images/rickshaw.jpg" alt="rickshaw">
                <p>Pedal Rickshaw</p>
                <p class="desc">A traditional human-powered three-wheeler used for short-distance transport.</p>
            </div>

            <div class="box">
                <img src="Images/autorickshaw.jpg" alt="auto rickshaw">
                <p>Bangla Tesla</p>
                <p class="desc">A popular three-wheeled motorized vehicle.</p>
            </div>

        </div>

    </section>

    <a href="../controller/VehicleController.php" class="btn">Shop Now</a>

    <?php if(file_exists('user_footer.php')) include 'user_footer.php'; ?>

</body>
</html>