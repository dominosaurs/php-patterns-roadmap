<?php
require_once '../../../database/pdo.php';

if (count($_POST) > 0) {
    $statement = $pdo->prepare(
        'UPDATE categories SET
            name = :name,
            color = :color
        WHERE id = :id'
    );
    $statement->execute([
        ':name' => $_POST['name'],
        ':color' => $_POST['color'],
        ':id' => $_POST['id'],
    ]);

    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM categories WHERE id = ?');
$stmt->execute([$_GET['id']]);
$cat = $stmt->fetch();

if (! $cat) {
    exit('Category not found.');
}

$title = 'Update Category';
include '../_includes/header.php';
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $cat['id'] ?>">
    <p>
        <label>Category name</label>
        <input type="text" name="name" required value="<?= htmlspecialchars($cat['name']) ?>">
    </p>
    <p>
        <label>Color (Hex)</label>
        <input type="color" name="color" value="<?= htmlspecialchars($cat['color'] ?? '#000000') ?>">
    </p>
    <button type="submit">Update Category</button>
    <a href="index.php">Cancel</a>
</form>

<?php include '../_includes/footer.php'; ?>