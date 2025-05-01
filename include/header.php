<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            padding: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .content { flex: 1; padding: 20px; }
    </style>
</head>
<body>
<div class="sidebar">
    <h3 style="color: white;">Inventory</h3>
    <a href="dashboard.php">Dashboard</a>
    <a href="suppliers.php">Suppliers</a>
    <a href="categories.php">Categories</a>
    <a href="products.php">Products</a>
    <a href="chatbot.php">Chatbot</a>
    <a href="../backend/logout.php">Logout</a>
</div>
<div class="content">
    <h4>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?></h4>
