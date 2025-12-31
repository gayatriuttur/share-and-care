<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // If not logged in, redirect to login page
    header("Location: admin_login.html");
    exit();
}
require "db_connect.php";
$sql="SELECT * FROM donations ORDER BY id DESC";
$RESULT=$conn->query($sql);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "share_and_care";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM donations ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donation Requests</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>All Donation Requests</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Donor Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Pickup Date</th>
        <th>Pickup Time</th>
        <th>Donation Type</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["donor_name"]."</td>
                    <td>".$row["phone"]."</td>
                    <td>".$row["address"]."</td>
                    <td>".$row["pickup_date"]."</td>
                    <td>".$row["pickup_time"]."</td>
                    <td>".$row["donation_type"]."</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No donations yet</td></tr>";
    }
    ?>

</table>

</body>
</html>

<?php
$conn->close();
?>