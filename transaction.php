<?php
include 'connectionString.php'; // Adjust the path as needed
include 'auth.php'; // Ensure the user is logged in and has the appropriate role

// Initialize search query
$searchProductName = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchProductName = mysqli_real_escape_string($con, $_GET['search']);
}

// Fetch all transactions with product details
$sql = "SELECT t.id, t.product_id, t.quantity, t.price, t.total, t.created_at, i.product_name 
        FROM transaction t
        JOIN item_table i ON t.product_id = i.product_id";

if ($searchProductName) {
    $sql .= " WHERE i.product_name LIKE '%$searchProductName%'";
}

$sql .= " ORDER BY t.created_at DESC";
$result = mysqli_query($con, $sql) or die("Query unsuccessful");

// Fetch aggregate values with the same filter
$aggregateSql = "SELECT SUM(t.quantity) AS total_quantity, SUM(t.total) AS total_price 
                  FROM transaction t
                  JOIN item_table i ON t.product_id = i.product_id";

if ($searchProductName) {
    $aggregateSql .= " WHERE i.product_name LIKE '%$searchProductName%'";
}

$aggregateResult = mysqli_query($con, $aggregateSql);
$aggregateData = mysqli_fetch_assoc($aggregateResult);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Records</title>
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
        .filterbox {
            margin-bottom: 20px;
        }
        .aggregate-info {
            margin-top: 20px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1>Transaction Records</h1>
        </div>
        <div id="menu">
            <ul>
                <li>
                    <a href="index.php">Back</a>
                </li>
            </ul>
        </div>
        <div id="main-content">
            <div class="filterbox">
                <h2>All Transactions</h2>
                <form method="GET" action="transaction.php">
                    <input type="text" name="search" placeholder="Search by product name" value="<?php echo htmlspecialchars($searchProductName); ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
            
            <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td>$<?php echo number_format($row['price'], 2); ?></td>
                        <td>$<?php echo number_format($row['total'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p>No transactions found.</p>
            <?php endif; ?>
            
            <!-- Display aggregate information -->
            <div class="aggregate-info">
                <p><strong>Total Quantity:</strong> <?php echo htmlspecialchars($aggregateData['total_quantity']); ?></p>
                <p><strong>Total Price:</strong> $<?php echo number_format($aggregateData['total_price'], 2); ?></p>
            </div>

            <?php
            mysqli_free_result($result);
            mysqli_free_result($aggregateResult);
            mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>
