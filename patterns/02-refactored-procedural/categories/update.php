<?php
require_once '../_includes/functions.php';

$id = $_GET['id'] ?? null;

if (count($_POST) > 0) {
    db_query('UPDATE categories SET name = :name, color = :color WHERE id = :id', [
        ':name' => $_POST['name'],
        ':color' => $_POST['color'],
        ':id' => $id,
    ]);
    redirect('index.php');
}

$category = db_get_one('SELECT * FROM categories WHERE id = :id', [':id' => $id]);

if (! $category) {
    exit('Category not found');
}

$title = 'Update Category';
include '../_includes/header.php';
?>

<form method="POST">
    <p>
        <label>Category name</label>
        <input type="text" name="name" value="<?= e($category['name']) ?>" required>
    </p>
    <p>
        <label>Color (Hex)</label>
        <input type="color" name="color" value="<?= e($category['color'] ?? '#000000') ?>">
    </p>
    <button type="submit">Update Category</button>
    <a href="index.php">Cancel</a>
</form>

<?php include '../_includes/footer.php'; ?>