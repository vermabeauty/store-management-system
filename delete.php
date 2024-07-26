<?php
include 'connectionString.php'; // Adjust this if your file name is different
include 'auth.php';

if (!isset($_GET['id'])) {
    echo "No user ID provided.";
    exit;
}

$id = intval($_GET['id']);

$delete_sql = "DELETE FROM `user` WHERE `id` = $id";
if (mysqli_query($con, $delete_sql)) {
    header("Location: employee.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
mysqli_close($con);
?>
