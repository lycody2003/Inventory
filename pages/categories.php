<?php
include('../include/header.php');
include('../include/db.php');

$user_id = $_SESSION['user_id'];
$categories = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
$categories->execute([$user_id]);
?>

<!-- Bootstrap Container -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Page Title -->
            <h2 class="text-center text-primary mb-4">📁 Categories</h2>

            <!-- Add Category Form -->
            <div class="card mb-4 shadow-sm border-info">
                <div class="card-header bg-info text-white">
                    <strong>Add New Category</strong>
                </div>
                <div class="card-body">
                    <form action="../backend/category/create.php" method="post" class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success">➕ Add Category</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="card shadow-sm border-secondary">
                <div class="card-header bg-secondary text-white">
                    <strong>All Categories</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th class="text-center" style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $categories->fetch()) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']); ?></td>
                                    <td class="text-center">
                                        <form action="../backend/category/delete.php" method="get" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?');">🗑 Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <?php if ($categories->rowCount() === 0): ?>
                                <tr>
                                    <td colspan="2" class="text-center text-muted">No categories found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Include footer -->
<?php include('../include/footer.php'); ?>
