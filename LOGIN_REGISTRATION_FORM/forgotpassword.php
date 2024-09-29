<?php
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
    $username = $_POST['username'];
    $contact = $_POST['contact'];

    // Check if user exists with this username and contact (email/phone)
    $sql = "SELECT * FROM users WHERE username = ? AND (email = ? OR phone = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $contact, $contact);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate OTP and store it in the session or database
        $otp = rand(100000, 999999);
        session_start();
        $_SESSION['otp'] = $otp;
        $_SESSION['username'] = $username;
        $_SESSION['contact'] = $contact;

        // Send OTP to the user's email and phone number (pseudo code for sending email and SMS)
        // mail($contact, "Your OTP", "Your OTP is: $otp");
        // send_sms($contact, "Your OTP is: $otp");

        echo "<script>alert('OTP sent to your email and phone number.'); window.location.href='verify_otp.html';</script>";
    } else {
        echo "<script>alert('Invalid username or contact information!'); window.location.href='forgotpassword.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
