<?php

use App\P04\Core\View;

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
        <?php foreach ($categories as $cat) { ?>
            <tr>
                <td>
                    <span style="color: <?= $cat['color'] ?? '#000' ?>;">●</span>
                    <?= View::escape($cat['name']) ?>
                </td>
                <td><code><?= View::escape($cat['color'] ?? '-') ?></code></td>
                <td>
                    <a href="<?= View::url('categories/update?id='.$cat['id']) ?>">Edit</a>
                    <a href="<?= View::url('categories/delete?id='.$cat['id']) ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<p>
    <a href="<?= View::url('categories/create') ?>" class="button">Add New Category</a>
</p>