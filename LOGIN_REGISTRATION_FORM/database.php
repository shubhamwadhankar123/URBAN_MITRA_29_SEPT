<?php
$servername = "localhost";  // Change if necessary
$username = "root";         // Your MySQL username
$password = "Shubhamw@1234"; // Your MySQL password
$dbname = "user_auth";      // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the database!";
}
?>
