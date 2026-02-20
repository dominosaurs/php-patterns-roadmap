<?php

use App\P04\Core\View;

?>

<?php if (empty($todos)) { ?>
    <article>
        <p>
            <code>No todos found. Start by <a href="<?= View::url('todo/create') ?>">adding your first task</a>.</code>
        </p>
    </article>
<?php } else { ?>
    <table>
        <thead>
            <tr>
                <th style="width: 50px;">Status</th>
                <th>Task</th>
                <th>Category & Tags</th>
                <th style="width: 100px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos as $todo) { ?>
                <tr>
                    <td style="text-align: center;">
                        <?= $todo['is_completed'] ? '✅' : '⏳' ?>
                    </td>
                    <td>
                        <a href="<?= View::url('todo/read?id='.$todo['id']) ?>">
                            <strong><?= View::escape($todo['name']) ?></strong>
                        </a>
                    </td>
                    <td>
                        <?php if ($todo['category_name']) { ?>
                            <mark style="background-color: <?= $todo['category_color'] ?? '#eee' ?>; color: white;">
                                <?= View::escape($todo['category_name']) ?>
                            </mark>
                        <?php } ?>

                        <?php if ($todo['tag_names']) { ?>
                            <?php foreach (explode(',', $todo['tag_names']) as $tag) { ?>
                                <code>#<?= View::escape($tag) ?></code>
                            <?php } ?>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="<?= View::url('todo/update?id='.$todo['id']) ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<p>
    <a href="<?= View::url('todo/create') ?>" class="button">Add New Todo</a>
</p>

