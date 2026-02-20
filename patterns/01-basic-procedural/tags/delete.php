<?php
require_once '../../../database/pdo.php';

$id = (int) ($_GET['id'] ?? 0);

if (count($_POST) > 0) {
    $statement = $pdo->prepare('DELETE FROM tags WHERE id = :id');
    $statement->execute([':id' => $_POST['id']]);

    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT name FROM tags WHERE id = ?');
$stmt->execute([$id]);
$tag = $stmt->fetch();

if (! $tag) {
    exit('Tag not found.');
}

$title = 'Delete Tag';
include '../_includes/header.php';
?>

<article>
    <p>Are you sure you want to delete the tag <strong>#<?= htmlspecialchars($tag['name']) ?></strong>?</p>
    <p><small>Note: This will remove this tag from all Todos.</small></p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="submit">Delete Tag</button>
        <a href="index.php">Cancel</a>
    </form>
</article>

<?php include '../_includes/footer.php'; ?>