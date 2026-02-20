<?php
require_once '../../../database/pdo.php';

if (count($_POST) > 0) {
    $statement = $pdo->prepare(
        "UPDATE tags SET name = :name WHERE id = :id"
    );
    $statement->execute([
        ':name' => $_POST['name'],
        ':id' => $_POST['id']
    ]);

    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM tags WHERE id = ?');
$stmt->execute([$_GET['id']]);
$tag = $stmt->fetch();

if (!$tag)
    die("Tag not found.");

$title = 'Update Tag #' . $tag['id'];
include '../_includes/header.php';
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $tag['id'] ?>">
    <p>
        <label>Tag Name</label>
        <input type="text" name="name" required value="<?= htmlspecialchars($tag['name']) ?>">
    </p>
    <button type="submit">update tag</button>
    <a href="index.php">cancel</a>
</form>

<?php include '../_includes/footer.php'; ?>