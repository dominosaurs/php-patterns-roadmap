<?php
require_once '../_includes/functions.php';

$tags = db_get_all('SELECT * FROM tags ORDER BY name');

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
        <?php foreach ($tags as $tag) { ?>
            <tr>
                <td>#<?= e($tag['name']) ?></td>
                <td>
                    <a href="update.php?id=<?= $tag['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $tag['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<p>
    <a href="create.php" class="button">Add New Tag</a>
</p>

<?php include '../_includes/footer.php'; ?>