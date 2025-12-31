<?php
include 'db_connect.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // If not logged in, redirect to login page
    header("Location: admin_login.html");
    exit();
}
?>
<?php

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "share_and_care";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users
$sql = "SELECT id, name, email, phone, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Users</title>
<style>
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
}
th {
    background-color: #1e7a34;
    color: white;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
</head>
<body>

<h2 style="text-align:center;">Registered Users</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Registered At</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found</td></tr>";
}
$conn->close();
?>
</table>

</body>
</html>