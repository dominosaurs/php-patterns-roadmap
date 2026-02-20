<?php
require_once '../../../database/pdo.php';

$statement = $pdo->query("SELECT * FROM tags ORDER BY name");
$tags = $statement->fetchAll();

$title = 'Manage Tags';
include '../_includes/header.php';
?>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tags as $tag): ?>
            <tr>
                <td>#<?= htmlspecialchars($tag['name']) ?></td>
                <td>
                    <a href="update.php?id=<?= $tag['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $tag['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="create.php" class="button">Add New Tag</a>
</p>

<?php include '../_includes/footer.php'; ?>