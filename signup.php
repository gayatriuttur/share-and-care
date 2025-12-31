<?php
include 'db_connect.php';
// Connect to MySQL Database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "share_and_care"; // make sure this DB exists in phpMyAdmin
 
$conn=new mysqli($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only handle POST requests (when form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data from signup.html
    $name  = $_POST['name']      ?? '';
    $email = $_POST['email']     ?? '';
    $phone = $_POST['phone']     ?? '';
    $pass  = $_POST['password']  ?? '';
    $cpass = $_POST['cpassword'] ?? '';

    // Basic check
    if ($pass !== $cpass) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    // Check if email already used
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists!'); window.history.back();</script>";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Hash password and insert user
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Account created successfully!'); window.location='login.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    // If someone opens signup.php directly, send them to signup form
    header("Location: sign up.html");
    exit();
}
?>?