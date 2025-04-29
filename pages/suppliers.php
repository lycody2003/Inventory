<?php
include('../include/header.php');
include('../include/db.php');

$user_id = $_SESSION['user_id'];
$suppliers = $pdo->prepare("SELECT * FROM suppliers WHERE user_id = ?");
$suppliers->execute([$user_id]);
?>

<h2>Suppliers</h2>

<form action="../backend/supplier/create.php" method="post">
    Name: <input type="text" name="name" autocomplete="off" required>
    Contact Info: <input type="text" name="contact_info" autocomplete="off" required>
    <button type="submit">Add Supplier</button>
</form>

<br><table class="table">
<thead><tr><th>Name</th><th>Contact Info</th><th>Action</th></tr></thead>
<tbody>
<?php while ($row = $suppliers->fetch()) : ?>
<tr>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['contact_info']); ?></td>
    <td>
        <form action="../backend/supplier/delete.php" method="get" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="btn btn-danger btn-sm">Delete</button>
        </form>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php include('../include/footer.php'); ?>
