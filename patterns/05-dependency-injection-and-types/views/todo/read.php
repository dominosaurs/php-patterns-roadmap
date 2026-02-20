<?php

use App\P04\Core\View;

?>

<p>
    <a href="<?= View::url('todo/index') ?>">← Back to list</a>
</p>

<h2>
    <?= View::escape($todo['name']) ?>
    <?= $todo['is_completed'] ? '✅' : '' ?>
</h2>

<p>
    <strong>Category:</strong>
    <?php if ($todo['category_name']) { ?>
        <mark style="background-color: <?= $todo['category_color'] ?? '#eee' ?>; color: white;">
            <?= View::escape($todo['category_name']) ?>
        </mark>
    <?php } else { ?>
        <em>None</em>
    <?php } ?>
</p>

<p>
    <strong>Tags:</strong>
    <?php if (empty($tags)) { ?>
        <em>None</em>
    <?php } else { ?>
        <?php foreach ($tags as $tag) { ?>
            <code>#<?= View::escape($tag['name']) ?></code>
        <?php } ?>
    <?php } ?>
</p>

<pre><?= View::escape($todo['description'] ?? 'No description provided') ?></pre>

<p>
    <small>Created at: <?= $todo['created_at'] ?></small>
</p>

<p>
    <a href="<?= View::url('todo/update?id='.$todo['id']) ?>" class="button">Edit</a>
    <a href="<?= View::url('todo/delete?id='.$todo['id']) ?>">Delete</a>
</p>