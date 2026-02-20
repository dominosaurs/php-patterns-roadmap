<?php
require_once '../_includes/functions.php';

$id = $_GET['id'] ?? null;

if (count($_POST) > 0) {
    db_query("UPDATE tags SET name = :name WHERE id = :id", [
        ':name' => $_POST['name'],
        ':id' => $id
    ]);
    redirect('index.php');
}

$tag = db_get_one("SELECT * FROM tags WHERE id = :id", [':id' => $id]);

if (!$tag)
    die("Tag not found");

$title = 'Update Tag';
include '../_includes/header.php';
?>

<form method="POST">
    <p>
        <label>Tag name</label>
        <input type="text" name="name" value="<?= e($tag['name']) ?>" required>
    </p>
    <button type="submit">Update Tag</button>
    <a href="index.php">Cancel</a>
</form>

<?php include '../_includes/footer.php'; ?>