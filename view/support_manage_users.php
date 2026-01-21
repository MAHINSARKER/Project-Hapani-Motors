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

<section class="support_section"> 

    <h1 class="title">Manage Customers</h1>

    <div class="search-container">
        <input type="text" onkeyup="searchUser(this.value)" placeholder="Search User Name..." class="search-input" value="<?= htmlspecialchars($search_input); ?>">
        <a href="Support_UserController.php" class="reset-btn">Reset</a>
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
            <tbody id="user_table_body">
                <?php 
                if(!empty($customer_list)){
                    foreach($customer_list as $row){
                ?> 
                <tr id="user_row_<?= $row['user_id']; ?>">
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['number']; ?></td>
                    <td><?= $row['address']; ?></td>
                    <td>
                        <a href="#" onclick="deleteUserAJAX(<?= $row['user_id']; ?>)" class="delete-link">Delete</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="5" class="empty">No customers found!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</section>

<script>
// 1. Live Search
function searchUser(str) {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("user_table_body").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../controller/Support_AjaxController.php?action=search_user&q=" + str);
  xhttp.send();
}

// 2. AJAX Delete User
function deleteUserAJAX(id) {
    Swal.fire({
        title: 'Delete User?', text: "You won't be able to revert this!",
        icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#d33', confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                if(this.responseText.trim() == "success"){
                    Swal.fire("Deleted!", "User has been removed.", "success");
                    
                    // Hide the row instantly
                    const row = document.getElementById("user_row_" + id);
                    if(row) row.style.display = "none";
                    
                } else {
                    Swal.fire("Error!", this.responseText, "error");
                }
            }
            
            xhttp.open("POST", "../controller/Support_AjaxController.php");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("action=delete_user&user_id=" + id);
        }
    })
}
</script>

</body>
</html>