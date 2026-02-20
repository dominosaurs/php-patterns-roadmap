<?php
require_once '_includes/functions.php';

$id = $_GET['id'] ?? null;

// Fetch Todo with Category
$todo = db_get_one(
    'SELECT
        todos.*,
        categories.name as category_name,
        categories.color as category_color 
    FROM todos 
    LEFT JOIN categories ON todos.category_id = categories.id 
    WHERE todos.id = :id',
    [':id' => $id]
);

if (! $todo) {
    exit('Todo not found.');
}

// Fetch Tags for this Todo
$tags = db_get_all(
    'SELECT tags.name
    FROM tags
    JOIN todo_tags ON tags.id = todo_tags.tag_id
    WHERE todo_tags.todo_id = :id',
    [':id' => $id]
);

$title = 'Todo Details';
include '_includes/header.php';
?>

<p>
    <a href="index.php">← Back to list</a>
</p>

<h2>
    <?= e($todo['name']) ?>
    <?= $todo['is_completed'] ? '✅' : '' ?>
</h2>

<p>
    <strong>Category:</strong>
    <?php if ($todo['category_name']) { ?>
        <mark style="background-color: <?= $todo['category_color'] ?? '#eee' ?>; color: white;">
            <?= e($todo['category_name']) ?>
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
            <code>#<?= e($tag['name']) ?></code>
        <?php } ?>
    <?php } ?>
</p>

<pre><?= e($todo['description'] ?? 'No description provided') ?></pre>

<p>
    <small>Created at: <?= $todo['created_at'] ?></small>
</p>

<p>
    <a href="update.php?id=<?= $todo['id'] ?>" class="button">Edit</a>
    <a href="delete.php?id=<?= $todo['id'] ?>">Delete</a>
</p>

<?php include '_includes/footer.php'; ?>