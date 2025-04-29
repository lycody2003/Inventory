<?php
include('../include/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        header('Location: ../pages/login.php');
        exit;
    } else {
        echo "Registration failed!";
        echo "<br>";
        echo "<a href='../pages/register.php'>Go back to register</a>";
        echo "<br>";
    }
}
?>
