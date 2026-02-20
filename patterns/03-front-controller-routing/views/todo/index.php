<?php include '_includes/header.php'; ?>

<?php if (empty($todos)): ?>
    <article>
        <p>
            <code>No todos found. Start by <a href="<?= url('todo/create') ?>">adding your first task</a>.</code>
        </p>
    </article>
<?php else: ?>
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
            <?php foreach ($todos as $todo): ?>
                <tr>
                    <td style="text-align: center;">
                        <?= $todo['is_completed'] ? '✅' : '⏳' ?>
                    </td>
                    <td>
                        <a href="<?= url('todo/read?id=' . $todo['id']) ?>">
                            <strong><?= e($todo['name']) ?></strong>
                        </a>
                    </td>
                    <td>
                        <?php if ($todo['category_name']): ?>
                            <mark style="background-color: <?= $todo['category_color'] ?? '#eee' ?>; color: white;">
                                <?= e($todo['category_name']) ?>
                            </mark>
                        <?php endif; ?>

                        <?php if ($todo['tag_names']): ?>
                            <?php foreach (explode(',', $todo['tag_names']) as $tag): ?>
                                <code>#<?= e($tag) ?></code>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= url('todo/update?id=' . $todo['id']) ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<p>
    <a href="<?= url('todo/create') ?>" class="button">Add New Todo</a>
</p>

<?php include '_includes/footer.php'; ?>