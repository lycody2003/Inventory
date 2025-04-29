<?php
include('../../include/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];

    $stmt = $pdo->prepare("INSERT INTO suppliers (user_id, name, contact_info) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $name, $contact_info]);

    header('Location: ../../pages/suppliers.php');
}
?>
