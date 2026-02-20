<?php
require_once '../_includes/functions.php';

$id = $_GET['id'] ?? null;

if (isset($_POST['confirm'])) {
    // 1. Unset category from todos
    db_query("UPDATE todos SET category_id = NULL WHERE category_id = :id", [':id' => $id]);

    // 2. Delete category
    db_query("DELETE FROM categories WHERE id = :id", [':id' => $id]);

    redirect('index.php');
}

$category = db_get_one("SELECT name FROM categories WHERE id = :id", [':id' => $id]);

if (!$category) {
    die("Category not found.");
}

$title = 'Delete Category';
include '../_includes/header.php';
?>

<article>
    <p>Are you sure you want to delete the category <strong><?= e($category['name']) ?></strong>?</p>
    <p><small>Note: Todos in this category will become uncategorized.</small></p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Category</button>
        <a href="index.php">Cancel</a>
    </form>
</article>

<?php include '../_includes/footer.php'; ?>