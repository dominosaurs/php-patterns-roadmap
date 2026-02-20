<?php
require_once '../../../database/pdo.php';

$id = (int) ($_GET['id'] ?? 0);

if (count($_POST) > 0) {
    $statement = $pdo->prepare(
        "DELETE FROM categories WHERE id = :id"
    );
    $statement->execute([':id' => $_POST['id']]);

    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT name FROM categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) {
    die("Category not found.");
}

$title = 'Delete Category';
include '../_includes/header.php';
?>

<article>
    <p>Are you sure you want to delete the category <strong><?= htmlspecialchars($category['name']) ?></strong>?</p>
    <p><small>Note: Todos in this category will become uncategorized.</small></p>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="submit">Delete Category</button>
        <a href="index.php">Cancel</a>
    </form>
</article>

<?php include '../_includes/footer.php'; ?>