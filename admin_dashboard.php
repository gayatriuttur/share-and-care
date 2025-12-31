<?php
session_start();

// Only allow admin to access this page
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        text-align: center;
        padding: 50px;
    }
    h2 {
        color: #145A23;
        margin-bottom: 30px;
    }
    .btn {
        display: block;
        width: 250px;
        margin: 15px auto;
        padding: 12px;
        background-color: #1E7A34;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        font-size: 16px;
    }
    .btn:hover {
        background-color: #145A23;
    }
</style>
</head>
<body>

<h2>Admin Dashboard</h2>

<a href="admin_view_users.php" class="btn">View Users</a>
<a href="view_donation.php" class="btn">View Donations</a>


</body>
</html>