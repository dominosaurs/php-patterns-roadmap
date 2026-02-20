<?php
require_once '../../database/pdo.php';

// Fetch Todo with Category
$statement = $pdo->prepare(
    "SELECT
        todos.*,
        categories.name as category_name,
        categories.color as category_color 
    FROM todos 
    LEFT JOIN categories ON todos.category_id = categories.id 
    WHERE todos.id = :id"
);
$statement->execute([':id' => $_GET['id']]);
$todo = $statement->fetch();

if (!$todo) {
    die("Todo not found.");
}

// Fetch Tags for this Todo
$tagStmt = $pdo->prepare("SELECT tags.name
    FROM tags
    JOIN todo_tags ON tags.id = todo_tags.tag_id
    WHERE todo_tags.todo_id = :id
");
$tagStmt->execute([':id' => $_GET['id']]);
$tags = $tagStmt->fetchAll();

$title = 'To Do #' . $todo['id'];
include '_includes/header.php';
?>

<p>
    <a href="index.php">← Back to list</a>
</p>

<h2>
    <?= htmlspecialchars($todo['name']) ?>
    <?= $todo['is_completed'] ? '✅' : '' ?>
</h2>

<p>
    <strong>Category:</strong>
    <?php if ($todo['category_name']): ?>
        <mark style="background-color: <?= $todo['category_color'] ?? '#eee' ?>; color: white;">
            <?= htmlspecialchars($todo['category_name']) ?>
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
            <code>#<?= htmlspecialchars($tag['name']) ?></code>
        <?php endforeach; ?>
    <?php endif; ?>
</p>

<pre><?= htmlspecialchars($todo['description'] ?? 'No description') ?></pre>

<p>
    <small>Created at: <?= $todo['created_at'] ?></small>
</p>

<p>
    <a href="update.php?id=<?= $todo['id'] ?>" class="button">edit</a>
    <a href="delete.php?id=<?= $todo['id'] ?>">delete</a>
</p>

<?php include '_includes/footer.php'; ?>