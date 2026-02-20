<?php
defined("APP_ACCESS") || die("Direct access forbidden.");
include '_includes/header.php'; ?>

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
                    <?= e($cat['name']) ?>
                </td>
                <td><code><?= e($cat['color'] ?? '-') ?></code></td>
                <td>
                    <a href="<?= url('categories/update?id=' . $cat['id']) ?>">Edit</a>
                    <a href="<?= url('categories/delete?id=' . $cat['id']) ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="<?= url('categories/create') ?>" class="button">Add New Category</a>
</p>

<?php include '_includes/footer.php'; ?>