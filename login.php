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
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "share_and_care"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get login data from form
$user = $_POST['user'];          // Email or phone
$pass = $_POST['password'];      // Plain password

// Check if login using email or phone
$sql = "SELECT * FROM users WHERE email='$user' OR phone='$user'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();
    $db_pass = $row['password'];

    // Verify hashed password
    if (password_verify($pass, $db_pass)) {
        echo "<script>alert('Login Successful!'); window.location='home.html';</script>";
        exit();
    } else {
        echo "<script>alert('Incorrect Password!'); window.history.back();</script>";
        exit();
    }

} else {
    echo "<script>alert('User not found!'); window.history.back();</script>";
    exit();
}

$conn->close();
?>