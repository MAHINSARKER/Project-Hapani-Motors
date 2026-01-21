<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../view/css/css.css"> 

<header class="navbar">
    <div class="logo">
        <img src="../view/Images/header.png" alt="Hapani Motors Logo">
        
        <a href="../controller/HomeController.php" class="nav_head">Hapani Motors</a>
    </div>

    <nav>
        <ul class="menu">
            <li><a href="../controller/HomeController.php">Home</a></li>
            <li><a href="../controller/VehicleController.php">Vehicles</a></li>
            <li><a href="../controller/AboutController.php">About Us</a></li>
            
            <li><a href="../controller/CartController.php">Cart</a></li>
            
            <li><a href="../controller/ContactController.php">Contact</a></li>
            
            <li id="sign_up"> 
                <a href="../controller/ProfileController.php">Profile</a>
                <ul>
                    <li><a href="../controller/OrderHistoryController.php">My Orders</a></li>
                    <li><a href="../controller/LogoutController.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<div class="page-spacer"></div>