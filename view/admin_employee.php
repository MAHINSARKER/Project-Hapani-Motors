<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Support Staff</title>    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comme:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="../view/Images/favicon.ico">
    <link rel="stylesheet" href="../view/css/css.css">
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="support_section">

    <h1 class="title">Manage Support Team</h1>

    <div class="search-container">
        <form action="" method="POST" onsubmit="return false;">
            <input type="text" name="search_box" onkeyup="searchStaff(this.value)" placeholder="Search by Name..." class="search-input" value="<?php echo htmlspecialchars($search_input); ?>">
            <button type="submit" name="search_btn" class="search-btn">Search</button>
            <a href="Admin_EmployeeController.php" class="reset-btn">Reset</a>
        </form>
    </div>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="staff_table_body">
                <?php 
                if(!empty($support_staff_list)){
                    foreach($support_staff_list as $row){
                ?> 
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>
                        <a href="#" onclick="confirmDelete(<?php echo $row['user_id']; ?>)" class="delete-link">Delete</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="5" class="empty">No support staff found!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</section>

<?php if($success_msg != ""): ?>
<script>
    Swal.fire({
        icon: "success", title: "Success", text: "<?php echo $success_msg; ?>", showConfirmButton: false, timer: 1500
    }).then(() => { window.location.href = "<?php echo $redirect_url; ?>"; });
</script>
<?php endif; ?>

<?php if($warning_msg != ""): ?>
<script>
    Swal.fire({ icon: "error", title: "Error", text: "<?php echo $warning_msg; ?>" });
</script>
<?php endif; ?>

<script>

function searchStaff(str) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {

    document.getElementById("staff_table_body").innerHTML = this.responseText;
  }

  xhttp.open("GET", "../controller/Admin_AjaxController.php?action=search_employee&q=" + str);
  xhttp.send();
}


function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'black',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "Admin_EmployeeController.php?delete=" + id;
        }
    })
}
</script>

</body>
</html>