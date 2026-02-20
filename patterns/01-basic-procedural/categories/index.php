<?php
require_once '../../../database/pdo.php';

$statement = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $statement->fetchAll();

$title = 'Manage Categories';
include '../_includes/header.php';
?>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Color</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $cat): ?>
            <tr>
                <td>
                    <span style="color: <?= $cat['color'] ?? '#000' ?>;">●</span>
                    <?= htmlspecialchars($cat['name']) ?>
                </td>
                <td><code><?= htmlspecialchars($cat['color'] ?? '-') ?></code></td>
                <td>
                    <a href="update.php?id=<?= $cat['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $cat['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="create.php" class="button">Add New Category</a>
</p>

<?php include '../_includes/footer.php'; ?>