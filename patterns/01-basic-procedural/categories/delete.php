<?php
require_once '../../../database/pdo.php';

if (count($_POST) > 0) {
    $statement = $pdo->prepare(
        "DELETE FROM categories WHERE id = :id"
    );
    $statement->execute([':id' => $_POST['id']]);

    header('Location: index.php');
    exit;
}

$title = 'Delete Category #' . $_GET['id'];
include '../_includes/header.php';
?>

<p>Are you sure you want to delete category #<?= (int) $_GET['id'] ?>?</p>
<p><small>Note: Todos in this category will become uncategorized.</small></p>

<form method="POST">
    <input type="hidden" name="id" value="<?= (int) $_GET['id'] ?>">
    <button type="submit">yes, delete</button>
    <a href="index.php">cancel</a>
</form>

<?php include '../_includes/footer.php'; ?>