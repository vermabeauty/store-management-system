<?php
  include 'connectionString.php';
  include 'auth.php';
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
                    <a href="index.php">back</a>
                </li>
                <li>
                    <a href="additem.php">Add</a>
                </li>
            </ul>
        </div>

<div id="main-content">
    <div class="filterbox">
        <h2 class="filtertext">All Records</h2>
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for product names..">
    </div>
    <?php
     $counter=1;
     $sql="SELECT * FROM `item_table`;";
     $result=mysqli_query($con,$sql) or die("query unsuccessful");

     if(mysqli_num_rows($result)>0) {
    ?>
    <table cellpadding="7px" id='itemTable'>
        <thead>
        <th>SrNo</th>
        <th>product name</th>
        <th>prize</th>
        <th>brought</th>
        <th>stock</th>
        <th>Action</th>
        </thead>
        <tbody>
            <?php
            $counter=1;
            while($row=mysqli_fetch_assoc($result))
            {
            ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['prize']; ?></td>
                <td><?php echo $row['brought']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                    <a href='edititem.php?id=<?php echo $row['product_id'];?>'>Edit</a>
                    <a href='deleteitem.php?id=<?php echo $row['product_id'];?>'>Delete</a>
                </td>
            </tr>
            <?php 
            $counter++;
        } ?>
           
        </tbody>
    </table>
    <?php }
    else{
        echo "<h2>no record found<h2>";
    } 
    mysqli_close($con);
    ?>
</div>
</div>
<script>
    function searchTable() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("itemTable");
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
