<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // If not logged in, redirect to login page
    header("Location: admin_login.html");
    exit();
}
?>
<?php
// Connect to MySQL Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "share_and_care"; // create this database in phpMyAdmin

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    // Get form data
$name = $_POST['name'] ;
$email = $_POST['email'];
$phone = $_POST['phone'];
$pass = $_POST['password'];
$cpass = $_POST['cpassword'];

// Password Match Check
if ($pass !== $cpass) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit();
}

// Check if email is already used
$stmt =$conn->prepare( "SELECT * FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists!'); window.history.back();</script>";
    exit();
}

// Insert user
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
$stmt=$conn->prepare("INSERT INTO users (name,email,phone,password)VALUES(?,?,?,?)");
$stmt->bind_param("ssss",$name,$email,$phone,$hashed_password);



if ($stmt->execute()) {
    echo "<script>alert('Account created successfully!'); window.location='home..html';</script>";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>