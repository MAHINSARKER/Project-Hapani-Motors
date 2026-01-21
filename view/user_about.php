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
    <link rel="stylesheet" href="css/css.css">
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
    
    <p class="about_h1">About Us</p>

    <p class="about_p">
        Welcome to হাপানি মটরস (Hapani Motors) — your trusted destination for modern,
        eco-friendly, and affordable local transportation solutions.
    </p>  

    <p class="about_p">
        At Hapani Motors, we are committed to transforming everyday commuting by providing
        reliable vehicles that are both cost-effective and environmentally responsible.
        From traditional paddle rickshaws to innovative electric auto-rickshaws (Bangla Tesla),
        we focus on meeting the needs of urban and rural transportation across Bangladesh.
    </p>
    
    <h3 class="about_h3">Our Mission</h3>
    <p class="about_p">
        Our mission is to make transportation simple, accessible, and sustainable for everyone.
        We aim to support small business owners, drivers, and communities by offering
        high-quality vehicles at competitive prices while maintaining excellent customer service.
    </p>

    <h3 class="about_h3">What We Offer</h3>
    <ul class="about_ul">
        <li>🚲 Paddle Rickshaws</li>
        <li>⚡ Electric Auto-Rickshaws (Bangla Tesla)</li>
        <li>🔧 Quality parts and accessories</li>
    </ul>
    <p class="about_p">
        <strong>*Each product is carefully selected to ensure durability, safety, and long-term value.</strong>
    </p>
    
    <h3 class="about_h3">Why Choose Us?</h3>
    <ul class="about_ul">
        <li>✔ Affordable pricing</li>
        <li>✔ Trusted local brand</li>
        <li>✔ Customer-focused service</li>
        <li>✔ Quality-checked products</li>
        <li>✔ Support for sustainable transport</li>
    </ul>
    <p class="about_p">
        We believe in building long-term relationships with our customers based on trust,
        honesty, and reliability.
    </p>

    <h3 class="about_h3">Our Vision</h3>
    <p class="about_p">
        Our vision is to become a leading name in Bangladesh’s eco-friendly transport industry,
        contributing to a cleaner environment and a smarter transportation system for future generations.
    </p>

    <h3 class="about_h3">Get in Touch</h3>
    <p class="about_p">
        We are always happy to help! Whether you’re a customer, dealer, or partner —
        feel free to contact us for any inquiries or support.
    </p>

    <p class="about_p">
        <strong>Hapani Motors — Driving the future, responsibly.</strong>
    </p>

    <?php include 'user_footer.php'; ?>

</body>
</html>