<?php
require_once '../../database/pdo.php';

if (count($_POST) > 0) {
    $statement = $pdo->prepare('DELETE FROM todos WHERE id = :id');
    $statement->execute([':id' => $_POST['id']]);

    header('Location: index.php');
    exit;
}

$title = 'Delete To Do #' . $_GET['id'];
include '_includes/header.php';
?>

<p>
    <strong>Are you sure?</strong>
    Todo #<?= (int) $_GET['id'] ?> cannot be recovered.
</p>

<form method="POST">
    <input type="hidden" name="id" value="<?= (int) $_GET['id'] ?>">
    <button type="submit">Yes, Delete</button>
    <a href="read.php?id=<?= (int) $_GET['id'] ?>">Cancel</a>
</form>

<?php include '_includes/footer.php'; ?>