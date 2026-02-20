<?php
require_once '../_includes/functions.php';

$id = $_GET['id'] ?? null;

if (isset($_POST['confirm'])) {
    // 1. Delete pivot table entries
    db_query("DELETE FROM todo_tags WHERE tag_id = :id", [':id' => $id]);

    // 2. Delete the tag
    db_query("DELETE FROM tags WHERE id = :id", [':id' => $id]);

    redirect('index.php');
}

$tag = db_get_one("SELECT name FROM tags WHERE id = :id", [':id' => $id]);

if (!$tag) {
    die("Tag not found.");
}

$title = 'Delete Tag';
include '../_includes/header.php';
?>

<article>
    <p>Are you sure you want to delete the tag <strong>#<?= e($tag['name']) ?></strong>?</p>
    <p><small>Note: This will remove this tag from all Todos.</small></p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Tag</button>
        <a href="index.php">Cancel</a>
    </form>
</article>

<?php include '../_includes/footer.php'; ?>