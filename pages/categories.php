<?php
include('../include/header.php');
include('../include/db.php');

$user_id = $_SESSION['user_id'];
$categories = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
$categories->execute([$user_id]);
?>

<h2>Categories</h2>

<form action="../backend/category/create.php" method="post">
    Name: <input type="text" name="name" autocomplete="off" required>
    <button type="submit">Add Category</button>
</form>

<br><table class="table">
<thead><tr><th>Name</th><th>Action</th></tr></thead>
<tbody>
<?php while ($row = $categories->fetch()) : ?>
<tr>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td>
        <form action="../backend/category/delete.php" method="get" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php include('../include/footer.php'); ?>
