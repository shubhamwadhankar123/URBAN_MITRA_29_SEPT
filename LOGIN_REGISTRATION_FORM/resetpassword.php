<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$pass = 'Shubhamw@1234';
$dbname = 'user_auth';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate that passwords match
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='reset_password.html';</script>";
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $username = $_SESSION['username'];

    // Update the password in the database
    $sql = "UPDATE users SET password = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $username);

    if ($stmt->execute()) {
        // Success: Redirect to login page with success message
        echo "<script>alert('Password reset successful! You can now log in with your new password.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Failed to reset password. Please try again.'); window.location.href='reset_password.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
