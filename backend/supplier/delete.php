<?php
include('../../include/db.php');
session_start();

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM suppliers WHERE id = ?");
$stmt->execute([$id]);

header('Location: ../../pages/suppliers.php');
?>
