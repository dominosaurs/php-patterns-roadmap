<?php
require_once '../../database/pdo.php';

// Handle delete request
if (isset($_POST['confirm'])) {
    // 1. Delete from pivot table
    $pdo->prepare('DELETE FROM todo_tags WHERE todo_id = ?')
        ->execute([$_GET['id']]);

    // 2. Delete the todo
    $pdo->prepare('DELETE FROM todos WHERE id = ?')
        ->execute([$_GET['id']]);

    header('Location: index.php');
    exit;
}

// Fetch todo for confirmation
$stmt = $pdo->prepare('SELECT name FROM todos WHERE id = ?');
$stmt->execute([$_GET['id']]);
$todo = $stmt->fetch();

if (! $todo) {
    exit('Todo not found.');
}

$title = 'Delete Todo';
include '_includes/header.php';
?>

<article>
    <p>
        Are you sure you want to delete <strong><?= htmlspecialchars($todo['name']) ?></strong>?
    </p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Todo</button>
        <a href="read.php?id=<?= $_GET['id'] ?>">Cancel</a>
    </form>
</article>

<?php include '_includes/footer.php'; ?>