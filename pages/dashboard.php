<?php
include('../include/db.php');
include('../include/header.php');

$userId = $_SESSION['user_id'];

// Fetch Categories
$categories = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
$categories->execute([$userId]);
$categoryRows = $categories->fetchAll(PDO::FETCH_ASSOC);

// Fetch Suppliers
$suppliers = $pdo->prepare("SELECT * FROM suppliers WHERE user_id = ?");
$suppliers->execute([$userId]);
$supplierRows = $suppliers->fetchAll(PDO::FETCH_ASSOC);

// Fetch Products
$products = $pdo->prepare("
    SELECT p.*, c.name AS category_name, s.name AS supplier_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN suppliers s ON p.supplier_id = s.id
    WHERE p.user_id = ?
");
$products->execute([$userId]);
$productRows = $products->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Bootstrap Container -->
<div class="container mt-5">
    <h2 class="mb-4 text-primary">📊 Dashboard</h2>

    <!-- Categories -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">📁 Categories</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categoryRows as $cat): ?>
                        <tr>
                            <td><?= $cat['id'] ?></td>
                            <td><?= htmlspecialchars($cat['name']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Suppliers -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">🚚 Suppliers</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($supplierRows as $sup): ?>
                        <tr>
                            <td><?= $sup['id'] ?></td>
                            <td><?= htmlspecialchars($sup['name']) ?></td>
                            <td><?= htmlspecialchars($sup['contact_info']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Products -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">📦 Products</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productRows as $prod): ?>
                        <tr>
                            <td><?= $prod['id'] ?></td>
                            <td><?= htmlspecialchars($prod['name']) ?></td>
                            <td><?= htmlspecialchars($prod['category_name']) ?></td>
                            <td><?= htmlspecialchars($prod['supplier_name']) ?></td>
                            <td>$<?= number_format($prod['price'], 2) ?></td>
                            <td><?= $prod['stock'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('../include/footer.php'); ?>
