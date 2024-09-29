<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entered_otp = $_POST['otp'];

    // Check if the entered OTP matches the one generated
    if ($entered_otp == $_SESSION['otp']) {
        // OTP is correct, redirect to the password reset page
        echo "<script>alert('OTP Verified. Please enter a new password.'); window.location.href='reset_password.html';</script>";
    } else {
        echo "<script>alert('Invalid OTP! Please try again.'); window.location.href='verify_otp.html';</script>";
    }
}
?>
