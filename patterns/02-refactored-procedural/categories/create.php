<?php
require_once '../_includes/functions.php';

if (count($_POST) > 0) {
    db_query('INSERT INTO categories (name, color) VALUES (:name, :color)', [
        ':name' => $_POST['name'],
        ':color' => $_POST['color'],
    ]);
    redirect('index.php');
}

$title = 'Add New Category';
include '../_includes/header.php';
?>

<form method="POST">
    <p>
        <label>Category name</label>
        <input type="text" name="name" required>
    </p>
    <p>
        <label>Color (Hex)</label>
        <input type="color" name="color" value="#000000">
    </p>
    <button type="submit">Save Category</button>
    <a href="index.php">Cancel</a>
</form>

<?php include '../_includes/footer.php'; ?>