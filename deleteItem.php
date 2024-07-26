<?php
include 'connectionString.php'; // Adjust the path as needed

// Get the product_id from the query string
$product_id = $_GET['id'];

// Delete the item
$sql = "DELETE FROM `item_table` WHERE product_id = $product_id";
mysqli_query($con, $sql);

header('Location: item.php');
exit();

mysqli_close($con);
?>
