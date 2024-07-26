<?php
include 'connectionString.php'; // Adjust this if your file name is different
include 'auth.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password= mysqli_real_escape_string($con, $_POST['password']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    // Insert new user into the database
    $insert_sql = "INSERT INTO `user` (`username`, `email`, `salary`, `role`,`password`) VALUES ('$username', '$email', '$salary', '$role','$password')";

    if (mysqli_query($con, $insert_sql)) {
        header("Location: employee.php");
        exit();
    } else {
        echo "Error adding record: " . mysqli_error($con);
    }
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
            <h1>employee table</h1>
        </div>
        <div id="menu">
            <ul>
                <li>
                    <a href="employee.php">back</a>
                </li>
                <li>
                    <a href="add.php">Add</a>
                </li>
                <li>
            </ul>
        </div>
<div id="main-content">
    <h2>Add New Record</h2>
    <form class="post-form" action="" method="post">
        
       <div class="form-group">
            <label>Name</label>
            <input type="text" name="username" />
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="text" name="email" />
        </div>
        <div class="form-group">
            <label>Salary</label>
            <input type="text" name="salary" />
        </div>
        <div class="form-group">
            <label>Designation</label>
            <input type="text" name="role" />
        </div>
        <div class="form-group">
            <label>password</label>
            <input type="text" name="password" />
        </div>
        <input class="submit" type="submit" value="Save"  />
    </form>
</div>
</div>
</body>
</html>
