<?php include '_includes/header.php'; ?>

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
                <td>#<?= e($tag['name']) ?></td>
                <td>
                    <a href="<?= url('tags/update?id=' . $tag['id']) ?>">Edit</a>
                    <a href="<?= url('tags/delete?id=' . $tag['id']) ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="<?= url('tags/create') ?>" class="button">Add New Tag</a>
</p>

<?php include '_includes/footer.php'; ?>