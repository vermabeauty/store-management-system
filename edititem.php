<?php
include 'connectionString.php'; // Adjust the path as needed

// Get the product_id from the query string
$product_id = $_GET['id'];

// Fetch the existing item details
$sql = "SELECT * FROM `item_table` WHERE product_id = $product_id";
$result = mysqli_query($con, $sql);
$item = mysqli_fetch_assoc($result);

// Handle form submission for updating the item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $prize = $_POST['prize'];
    $stock = $_POST['stock'];

    $update_sql = "UPDATE `item_table` SET product_name='$product_name', prize='$prize', stock='$stock' WHERE product_id=$product_id";
    mysqli_query($con, $update_sql);

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
  <title>item table</title>
  <link rel="stylesheet" href="css/stylead.css">
  <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
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
                
            </ul>
        </div>

<div id="main-content">
    <h2>Update Record</h2>
    <form class="post-form" action="" method="post">
       
        <div class="form-group">
            <label>product name</label>
            <input type="text" name="product_name" value="<?php echo $item['product_name'] ;?>"/>
        </div>
        <div class="form-group">
            <label>price</label>
            <input type="hidden" name="product_id" value="<?php echo $item['product_id'] ;?>"/>
            <input type="text" name="prize" value="<?php echo $item['prize'] ;?>"/>
        </div>
        <div class="form-group">
            <label>stock</label>
            <input type="text" name="stock" value="<?php echo $item['stock'] ;?>"/>
        </div>
        <input class="submit" type="submit" value="Save"/>
    </form>
</div>
</div>
</body>
</html>
