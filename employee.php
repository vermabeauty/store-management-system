<?php
include 'connectionString.php'; // Adjust this if your file name is different
include 'auth.php';
// Determine the user role
$userRole = $_SESSION['role'];

// Set SQL query based on user role
if ($userRole === 'superadmin') {
    // Admin can view all records
    $sql = "SELECT * FROM `user` ORDER BY `username`";
    $result=mysqli_query($con,$sql) or die("query unsuccessful");
} elseif ($userRole === 'manager') {
    // Manager can only view staff
    $sql = "SELECT * FROM `user` WHERE `role` = 'staff' ORDER BY `username`";
    $result=mysqli_query($con,$sql) or die("query unsuccessful");
} else {
    echo "Access denied. You do not have permission to view this page.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/stylead.css">
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <title>Employee Records</title>
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
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        }
        #searchInput{
        border-radius:100px;
        }
    </style>
</head>
<body>
<div id="wrapper">
        <div id="header">
            <h1>Employee</h1>
        </div>
        <div id="menu">
            <ul>
                <li>
                    <a href="index.php">back</a>
                </li>
                <li>
                    <a href="add.php">Add</a>
                </li>
                <li>
                    <a href="#" style="color:yellow;">
                        <?php echo $_COOKIE['username']; ?>
                    </a>  
                </li>
            </ul>
        </div>

<div id="main-content">
        <div class="filterbox">
            <h2 class="filtertext">All Records</h2>
            <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for student names..">
        </div>
        <?php if (mysqli_num_rows($result) > 0): ?>
        <table id='employeeTable'>
            <thead>
                <tr>
                    <th>SrNo</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Designation</th>
                    <th>salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $counter=0;
                while ($row = mysqli_fetch_assoc($result)):
                $counter++;
                 ?>
                <tr>
                    <td><?php echo htmlspecialchars($counter); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['salary']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td>
                        <a href='edit.php?id=<?php echo htmlspecialchars($row['id']); ?>'>Edit</a>
                        <a href='delete.php?id=<?php echo htmlspecialchars($row['id']); ?>'>Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No records found.</p>
        <?php endif; ?>

        <?php
        mysqli_free_result($result);
        mysqli_close($con);
        ?>
    </div>
    <script>
    function searchTable() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("employeeTable");
      tr = table.getElementsByTagName("tr");
  
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Column index 1 is Student Name
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
</body>
</html>
