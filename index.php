<?php include 'auth.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>option</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/stylead.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="logo.jpg" type="image/x-icon">
    <style>
      

#heading {
    font-size: 3em;
    text-align: center;
    margin-top: 20px;
    color: #fff;
}

.container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    padding: 20px;
    margin-top: 20px;
}

.card {
    width: 300px;
    height: 300px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
}

.card img {
    width: 100%;
    height: auto;
    border-radius: 10px 10px 0 0;
}

.content {
    padding: 20px;
    text-align: center;
}

.content h3 {
    margin: 0;
    color: #333;
}

    </style>

</head>
<body>
    <div id="heading">Admin</div>
    <div class="container">
        <div class="card">
          <a href="employee.php"><img src="img/employee.jpg" alt="Alps" style="width:100%"></a>
          <div class="content">
            <h3>employee table</h3>
          </div>
        </div>
        <div class="card" >
          <a href="item.php"><img src="img/item.jpg" alt="Alps" style="width:100%"></a>
          <div class="content">
            <p>item table</p>
          </div>
        </div>
        <div class="card">
          <a href="bill.php"><img src="img/bill.jpg" alt="Alps" style="width:100%"></a>
          <div class="content">
            <p>bill</p>
          </div>
          </div>
          <div class="card">
          <a href="transaction.php"><img src="img/transaction.jpg" alt="Alps" style="width:100%"></a>
          <div class="content">
            <p>transaction</p>
          </div>
          </div>
        
          <div class="card">
            <a href="logout.php"><img src="img/home.jpg" alt="Alps" style="width:100%"></a>
            <div class="content">
              <p>logout</p>
            </div>
          </div>
          
        </div>
</body>
</html>