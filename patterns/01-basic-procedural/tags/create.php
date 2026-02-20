<?php
require_once '../../../database/pdo.php';

if (count($_POST) > 0) {
    $statement = $pdo->prepare(
        "INSERT INTO tags (name) VALUES (:name)"
    );
    $statement->execute([':name' => $_POST['name']]);

    header('Location: index.php');
    exit;
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