<?php
include('../../include/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];

    $stmt = $pdo->prepare("UPDATE suppliers SET name = ?, contact_info = ? WHERE id = ?");
    $stmt->execute([$name, $contact_info, $id]);

    header('Location: ../../pages/suppliers.php');
}
?>
