<?php
session_start(); // Start the session

// Destroy the session
session_unset();
session_destroy();

// Delete cookies related to the session
if (isset($_COOKIE['username'])) {
    setcookie('username', '', time() - (86400 * 30), '/'); // Expire the cookie
    setcookie("role", '', time() - (86400 * 30), "/");
}

// Redirect to the login page
header("Location: login.html");
exit();
?>
