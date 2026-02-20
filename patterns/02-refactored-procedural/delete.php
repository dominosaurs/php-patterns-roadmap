<?php
require_once '_includes/functions.php';

$id = $_GET['id'] ?? null;

// Confirm deletion logic
if (isset($_POST['confirm'])) {
    // 1. Delete pivot table entries
    db_query('DELETE FROM todo_tags WHERE todo_id = :id', [':id' => $id]);

    // 2. Delete the todo
    db_query('DELETE FROM todos WHERE id = :id', [':id' => $id]);

    redirect('index.php');
}

// Fetch todo for confirmation info
$todo = db_get_one('SELECT name FROM todos WHERE id = :id', [':id' => $id]);

if (! $todo) {
    exit('Todo not found.');
}

$title = 'Delete Todo';
include '_includes/header.php';
?>

<article>
    <p>
        Are you sure you want to delete <strong><?= e($todo['name']) ?></strong>?
    </p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Todo</button>
        <a href="read.php?id=<?= $id ?>">Cancel</a>
    </form>
</article>

<?php include '_includes/footer.php'; ?>