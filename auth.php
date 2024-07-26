<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    // User is not logged in, redirect to login page
    header("Location: login.html");
    exit();
}
?>
