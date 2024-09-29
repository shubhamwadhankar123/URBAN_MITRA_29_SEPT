<?php
require 'database.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user information from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch the user's hashed password from the database
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the entered password with the hashed password
        if (password_verify($password, $hashed_password)) {
            echo "Login successful!";
            // Redirect to a protected page or dashboard
            // header("Location: dashboard.php");
        } else {
            echo "Wrong username or password!";
        }
    } else {
        echo "Wrong username or password!";
    }

    $stmt->close();
}

$conn->close();
?>
