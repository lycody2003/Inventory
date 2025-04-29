<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Inventory</title>
</head>

<body>
    <h1>Login</h1>
    <form action="../backend/login.php" method="post">
        <h2>Login</h2>
        Username: <input type="text" name="username" autocomplete="off" required><br><br>
        Password: <input type="password" name="password" autocomplete="off" required><br><br>
        <button type="submit">Login</button>
    </form>
    <a href="register.php">Don't have an account? Register</a>

</body>

</html>