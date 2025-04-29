<?php
include('../../include/db.php');
session_start();

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
$stmt->execute([$id]);

header('Location: ../../pages/categories.php');
?>
