<?php include '_includes/header.php'; ?>

<p>
    <a href="<?= url('todo/index') ?>">← Back to list</a>
</p>

<h2>
    <?= e($todo['name']) ?>
    <?= $todo['is_completed'] ? '✅' : '' ?>
</h2>

<p>
    <strong>Category:</strong>
    <?php if ($todo['category_name']): ?>
        <mark style="background-color: <?= $todo['category_color'] ?? '#eee' ?>; color: white;">
            <?= e($todo['category_name']) ?>
        </mark>
    <?php else: ?>
        <em>None</em>
    <?php endif; ?>
</p>

<p>
    <strong>Tags:</strong>
    <?php if (empty($tags)): ?>
        <em>None</em>
    <?php else: ?>
        <?php foreach ($tags as $tag): ?>
            <code>#<?= e($tag['name']) ?></code>
        <?php endforeach; ?>
    <?php endif; ?>
</p>

<pre><?= e($todo['description'] ?? 'No description provided') ?></pre>

<p>
    <small>Created at: <?= $todo['created_at'] ?></small>
</p>

<p>
    <a href="<?= url('todo/update?id=' . $todo['id']) ?>" class="button">Edit</a>
    <a href="<?= url('todo/delete?id=' . $todo['id']) ?>">Delete</a>
</p>

<?php include '_includes/footer.php'; ?>