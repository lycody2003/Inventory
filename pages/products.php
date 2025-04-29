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

<h2>Products</h2>

<form action="../backend/product/create.php" method="post">
    Name: <input type="text" name="name" autocomplete="off" required><br><br>
    Price: <input type="number" step="0.01" name="price" autocomplete="off" required><br><br>
    Stock: <input type="number" name="stock" autocomplete="off" required><br><br>

    Category:
    <select name="category_id" required>
        <?php while ($cat = $categories->fetch()) : ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
        <?php endwhile; ?>
    </select><br><br>

    Supplier:
    <select name="supplier_id" required>
        <?php while ($sup = $suppliers->fetch()) : ?>
            <option value="<?php echo $sup['id']; ?>"><?php echo htmlspecialchars($sup['name']); ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Add Product</button>
</form>

<br><table class="table">
<thead><tr>
    <th>Name</th><th>Price</th><th>Stock</th><th>Category</th><th>Supplier</th><th>Action</th>
</tr></thead>
<tbody>
<?php while ($row = $products->fetch()) : ?>
<tr>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['price']); ?></td>
    <td><?php echo htmlspecialchars($row['stock']); ?></td>
    <td><?php echo htmlspecialchars($row['category_name']); ?></td>
    <td><?php echo htmlspecialchars($row['supplier_name']); ?></td>
    <td>
        <form action="../backend/product/delete.php" method="get" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php include('../include/footer.php'); ?>
