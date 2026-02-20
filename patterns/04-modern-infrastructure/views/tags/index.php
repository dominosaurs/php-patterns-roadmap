<?php

use App\P04\Core\View;

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
                <td>#<?= View::escape($tag['name']) ?></td>
                <td>
                    <a href="<?= View::url('tags/update?id='.$tag['id']) ?>">Edit</a>
                    <a href="<?= View::url('tags/delete?id='.$tag['id']) ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<p>
    <a href="<?= View::url('tags/create') ?>" class="button">Add New Tag</a>
</p>