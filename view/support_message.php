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

    <?php include 'support_header.php'; ?>

    <section class="messages-section">
        <p class="title">Customer Inquiries</p>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Number</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(!empty($messages_list)){
                        foreach($messages_list as $msg){
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($msg['contact_id']); ?></td>
                        <td><?= htmlspecialchars($msg['name']); ?></td>
                        <td><?= htmlspecialchars($msg['email']); ?></td>
                        <td><?= htmlspecialchars($msg['number']); ?></td>
                        <td style="max-width: 300px; word-wrap: break-word;"><?= htmlspecialchars($msg['message']); ?></td>
                    </tr>
                    <?php
                        }
                    } 
                    
                    else {
                        echo '<tr><td colspan="5" class="empty">You have no new messages!</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php if(!empty($success_msg)): ?>
    <script>
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "<?= $success_msg; ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    <?php endif; ?>

    <?php if(!empty($error_msg)): ?>
    <script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "<?= $error_msg; ?>"
        });
    </script>
    <?php endif; ?>

</body>
</html>