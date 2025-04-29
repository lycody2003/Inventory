<?php
$host = 'khmerstyleshop.c4fukwk0mge9.us-east-1.rds.amazonaws.com';
$dbname = 'inventory';
$username = 'admin';
$password = 'Chhunly$2003';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
