<?php
require_once '../_includes/functions.php';

if (count($_POST) > 0) {
    db_query('INSERT INTO tags (name) VALUES (:name)', [':name' => $_POST['name']]);
    redirect('index.php');
}

$title = 'Add New Tag';
include '../_includes/header.php';
?>

<form method="POST">
    <p>
        <label>Tag name</label>
        <input type="text" name="name" placeholder="e.g. urgent" required>
    </p>
    <button type="submit">Save Tag</button>
    <a href="index.php">Cancel</a>
</form>

<?php include '../_includes/footer.php'; ?>