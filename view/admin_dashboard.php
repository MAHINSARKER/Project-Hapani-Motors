<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>হাপানি মটরস - Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../view/css/css.css"> 
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
</head>
<body>

    <?php include 'admin_header.php'; ?>
    
    <div class="dash-title">Dashboard</div>
    
    <section class="dashboard-container">
       
        <div class="dash-box">
            <h3>$<span id="live_revenue"><?php echo number_format($total_revenue); ?></span>/-</h3>
            <p>Total Revenue</p>
        </div>

        <div class="dash-box">
            <h3><span id="live_orders"><?php echo $total_orders; ?></span></h3>
            <p>Total Orders Placed</p>
        </div>

    </section>

<script>
setInterval(function() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.status == 200) {
     
            const data = JSON.parse(this.responseText);
            
          
            document.getElementById("live_revenue").innerText = Number(data.revenue).toLocaleString();
            
       
            document.getElementById("live_orders").innerText = data.orders;
        }
    }

    xhttp.open("GET", "../controller/Admin_AjaxController.php?action=get_stats");
    xhttp.send();
}, 3000); 
</script>

</body>
</html>