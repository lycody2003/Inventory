<?php
include('../include/header.php');
include('../include/db.php');


$user_id = $_SESSION['user_id'];
$suppliers = $pdo->prepare("SELECT * FROM suppliers WHERE user_id = ?");
$suppliers->execute([$user_id]);
?>

<!-- Bootstrap Container -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Page Title -->
            <h2 class="text-center text-primary mb-4">🚚 Suppliers</h2>

            <!-- Add Supplier Form -->
            <div class="card mb-4 shadow-sm border-success">
                <div class="card-header bg-success text-white">
                    <strong>Add New Supplier</strong>
                </div>
                <div class="card-body">
                    <form action="../backend/supplier/create.php" method="post" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Info</label>
                            <input type="text" name="contact_info" class="form-control" required autocomplete="off">
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary mt-3">➕ Add Supplier</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Supplier Table -->
            <div class="card shadow-sm border-dark">
                <div class="card-header bg-dark text-white">
                    <strong>All Suppliers</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Contact Info</th>
                                <th class="text-center" style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $suppliers->fetch()) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']); ?></td>
                                    <td><?= htmlspecialchars($row['contact_info']); ?></td>
                                    <td class="text-center">
                                        <form action="../backend/supplier/delete.php" method="get" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this supplier?');">🗑 Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <?php if ($suppliers->rowCount() === 0): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No suppliers found.</td>
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
