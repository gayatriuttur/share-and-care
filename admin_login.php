<?php
session_start();

// Set admin username and password here
$admin_username = "gayatri";      // your admin username
$admin_password = "gayatri@1029";     // your admin password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        // Admin credentials correct → set session
        $_SESSION['admin_logged_in'] = true;
        header("Location:admin_dashboard.php"); // redirect to admin dashboard
        exit();
    } else {
        // Incorrect credentials → alert and go back
        echo "<script>
                alert('Invalid username or password!');
                window.history.back();
              </script>";
        exit();
    }
}
?>