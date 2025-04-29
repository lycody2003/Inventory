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
    <title>Register | Inventory</title>
</head>

<body>
    <h1>Register</h1>
    <form action="../backend/register.php" method="post">
        <h2>Register</h2>
        Username: <input type="text" name="username" autocomplete="off" required><br><br>
        Password: <input type="password" name="password" autocomplete="off" required><br><br>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>

</body>

</html>