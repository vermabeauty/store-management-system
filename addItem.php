<?php
include 'connectionString.php'; // Adjust the path as needed

// Handle form submission for adding a new item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $prize = $_POST['prize'];
    $brought = $_POST['brought'];
    $stock = $_POST['stock'];

    $insert_sql = "INSERT INTO `item_table` (product_name, prize, brought, stock) VALUES ('$product_name', '$prize', '$brought', '$stock')";
    mysqli_query($con, $insert_sql);

    header('Location: item.php');
    exit();
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>employee</title>
  <link rel="stylesheet" href="css/stylead.css">
  <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1>item table</h1>
        </div>
        <div id="menu">
            <ul>
                <li>
                    <a href="item.php">back</a>
                </li>
                <li>
                    <a href="additem.php">Add</a>
                </li>
                <li>
            </ul>
        </div>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="" method="post">
       
        <div class="form-group">
            <label>product_name</label>
            <input type="text" name="product_name" />
        </div>
        <div class="form-group">
           <label>price</label>
           <input type="number" name="prize"/>
       </div>
       <div class="form-group">
           <label>stock</label>
           <input type="number" name="stock" />
       </div>
       <div class="form-group">
           <label>Brought</label>
           <input type="date" name="brought" required/>
       </div>
       <input class="submit" type="submit" value="Save"/>
   </form>
</div>
</div>
</body>
</html>
