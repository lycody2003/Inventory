<?php
include('../include/header.php');
include('../include/db.php');

$user_id = $_SESSION['user_id'];

// Fetch categories
$categories = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
$categories->execute([$user_id]);

// Fetch suppliers
$suppliers = $pdo->prepare("SELECT * FROM suppliers WHERE user_id = ?");
$suppliers->execute([$user_id]);

// Fetch products with category and supplier name
$products = $pdo->prepare("
    SELECT p.*, c.name AS category_name, s.name AS supplier_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN suppliers s ON p.supplier_id = s.id
    WHERE p.user_id = ?
");
$products->execute([$user_id]);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Page Header -->
            <h2 class="text-center text-primary mb-4">📦 Product Management</h2>

            <!-- Product Form -->
            <div class="card mb-4 shadow-sm border-primary">
                <div class="card-header bg-primary text-white">
                    <strong>Add New Product</strong>
                </div>
                <div class="card-body">
                    <form action="../backend/product/create.php" method="post" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <?php while ($cat = $categories->fetch()) : ?>
                                    <option value="<?= $cat['id']; ?>"><?= htmlspecialchars($cat['name']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Supplier</label>
                            <select name="supplier_id" class="form-select" required>
                                <?php while ($sup = $suppliers->fetch()) : ?>
                                    <option value="<?= $sup['id']; ?>"><?= htmlspecialchars($sup['name']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success">➕ Add Product</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Product Table -->
            <div class="card shadow-sm border-secondary">
                <div class="card-header bg-secondary text-white">
                    <strong>All Products</strong>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Supplier</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $products->fetch()) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['name']); ?></td>
                                        <td><?= htmlspecialchars($row['price']); ?></td>
                                        <td><?= htmlspecialchars($row['stock']); ?></td>
                                        <td><?= htmlspecialchars($row['category_name']); ?></td>
                                        <td><?= htmlspecialchars($row['supplier_name']); ?></td>
                                        <td class="text-center">
                                            <form action="../backend/product/delete.php" method="get" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?');">🗑 Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                <?php if ($products->rowCount() === 0): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No products found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('../include/footer.php'); ?>
