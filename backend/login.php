<?php
include('../include/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../pages/dashboard.php');
        exit;
    } else {
        echo "Login failed!";
        echo "<br>";
        echo "<a href='../pages/login.php'>Go back to login</a>";
        echo "<br>";
    }
}
?>
