<?php
// Start session for user authentication
session_start();

// Dummy credentials (replace with a database for production)
$valid_username = "admin";
$valid_password = "admin123";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize inputs
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate credentials
    if ($username === $valid_username && $password === $valid_password) {
        // Redirect to admin.html on successful login
        header("Location: admin.html");
        exit();
    } else {
        // Redirect back to the login page with an error message
        $error_message = urlencode("Invalid username or password");
        header("Location: admin_login.php?error=$error_message");
        exit();
    }
} else {
    // Redirect to login page if the file is accessed directly
    header("Location: admin_login.php");
    exit();
}
