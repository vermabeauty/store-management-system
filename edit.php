<?php
include 'connectionString.php'; // Adjust this if your file name is different
include 'auth.php';

if (!isset($_GET['id'])) {
    echo "No user ID provided.";
    exit;
}

$id = intval($_GET['id']);

// Fetch the user details
$sql = "SELECT * FROM `user` WHERE `id` = $id";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) != 1) {
    echo "User not found.";
    exit;
}

$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $update_sql = "UPDATE `user` SET `username` = '$username', `email` = '$email', `salary` = '$salary', `role` = '$role' WHERE `id` = $id";
    if (mysqli_query($con, $update_sql)) {
        header("Location: employee.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
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
  <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
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
                
            </ul>
        </div>

<div id="main-content">
    <h2>Update Record</h2>
    
    <form method="POST" action="" class="post-form">
       <div class="form-group">
            <label>Name</label>
            <input type="text" name="username" value="<?php echo $user['username'] ;?>"/>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        </div>
        <div class="form-group">
            <label>Salary</label>
            <input type="text" name="salary" value="<?php echo $user['salary'] ;?>"/>
        </div>
        <div class="form-group">
            <label>Designation</label>
            <input type="text" name="role" value="<?php echo $user['role'] ;?>"/>
        </div>
        <input class="submit" type="submit" value="Save"  />
    </form>
</div>
</div>
</body>
</html>
