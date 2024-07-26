<?php
include 'connectionString.php';

// Start session management
session_start();

// Retrieve and sanitize username and password from POST request
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validate inputs
if (!empty($username) && !empty($password)) {
    // Sanitize input data to prevent SQL injection and XSS
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Prepare SQL statement to select user
    $sql = "SELECT * FROM `user` WHERE username=? AND password=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Set session or cookie based on user role
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        
        // Optionally, set cookies
        setcookie("username", $user['username'], time() + (86400 * 30), "/");
        setcookie("role", $user['role'], time() + (86400 * 30), "/");

        // Redirect to the homepage or dashboard
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid username or password.";
        header("Location: index.php");
        exit;
    }

    $stmt->close();
} else {
    echo "Please enter a username and password.";
    header("Location: login.html");
    exit;
}

$con->close();
?>
