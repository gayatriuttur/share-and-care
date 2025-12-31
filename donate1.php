<?php
include 'db_connect.php';
$servername="localhost";
$username="root";
$password="";
$dbname="share_and_care";
// Database connection
$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read form data
$donorName = $_POST['donorName'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$pickupDate = $_POST['pickupDate'];
$pickupTime = $_POST['pickupTime'];
$donationType = $_POST['donationType'];

// Insert into database
$sql = "INSERT INTO donations (donor_name, phone, address, pickup_date, pickup_time, donation_type)
        VALUES ('$donorName', '$phone', '$address', '$pickupDate', '$pickupTime', '$donationType')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Donation submitted successfully!'); window.location.href='donate.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>