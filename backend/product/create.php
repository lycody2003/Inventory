<?php
include('../../include/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $supplier_id = $_POST['supplier_id'];

    $stmt = $pdo->prepare("INSERT INTO products (user_id, name, price, stock, category_id, supplier_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $name, $price, $stock, $category_id, $supplier_id]);

    header('Location: ../../pages/products.php');
}
?>
