<?php
include 'connectionString.php'; // Adjust the path as needed
include 'auth.php'; // Ensure the user is logged in and has the appropriate role

// Handle form submission for creating a bill
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['items']) && isset($_POST['quantities']) && is_array($_POST['items']) && is_array($_POST['quantities'])) {
        $items = $_POST['items'];
        $quantities = $_POST['quantities'];
        $total = 0;

        foreach ($items as $index => $item_id) {
            $quantity = intval($quantities[$index]);
            $item_query = "SELECT prize, stock FROM `item_table` WHERE product_id = $item_id";
            $result = mysqli_query($con, $item_query);
            $item = mysqli_fetch_assoc($result);

            if ($item) {
                $item_price = $item['prize'];
                $item_stock = $item['stock'];

                if ($quantity > $item_stock) {
                    echo "<h2>Insufficient stock for item ID: $item_id</h2>";
                    mysqli_close($con);
                    exit();
                }

                $total += $item_price * $quantity;

                // Insert bill details into the database
                $insert_bill_query = "INSERT INTO `transaction` (product_id, quantity, price) VALUES ($item_id, $quantity, $item_price)";
                mysqli_query($con, $insert_bill_query);

                // Update stock in the item_table
                $update_stock_query = "UPDATE `item_table` SET stock = stock - $quantity WHERE product_id = $item_id";
                mysqli_query($con, $update_stock_query);
            } else {
                echo "<h2>Item ID: $item_id not found</h2>";
                mysqli_close($con);
                exit();
            }
        }

        echo "<h2>Total Bill Amount: $" . number_format($total, 2) . "</h2>";
        echo "<a href='bill.php'>Generate another bill</a>";
        mysqli_close($con);
        exit();
    } else {
        echo "<h2>Please select items and enter quantities.</h2>";
    }
}

// Fetch items for billing
$sql = "SELECT * FROM `item_table`";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Bill</title>
    <link rel="stylesheet" href="css/stylead.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        .form-container {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1>Generate Bill</h1>
        </div>
        <div id="menu">
            <ul>
                <li>
                    <a href="index.php">Back</a>
                </li>
            </ul>
        </div>
        <div id="main-content">
            <form action="bill.php" method="post">
                <h2>Select Items for Billing</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><input type="checkbox" name="items[]" value="<?php echo htmlspecialchars($row['product_id']); ?>"></td>
                            <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                            <td>$<?php echo number_format($row['prize'], 2); ?></td>
                            <td><input type="number" name="quantities[]" min="1" value="1" required></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="form-container">
                    <input type="submit" value="Generate Bill">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
