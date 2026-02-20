<?php
require_once '../../database/pdo.php';

// Handle POST request
if (count($_POST) > 0) {
    // 1. Update 'todos'
    $statement = $pdo->prepare(
        "UPDATE todos SET 
            category_id = :category_id,
            name = :name, 
            description = :description, 
            is_completed = :is_completed,
            updated_at = CURRENT_TIMESTAMP 
        WHERE id = :id"
    );
    $statement->execute([
        ':category_id' => !empty($_POST['category_id'])
            ? $_POST['category_id'] : null,
        ':name' => $_POST['name'],
        ':description' => empty($_POST['description'])
            ? null : $_POST['description'],
        ':is_completed' => isset($_POST['is_completed']) ? 1 : 0,
        ':id' => $_POST['id']
    ]);

    // 2. Update tags
    $pdo->prepare("DELETE FROM todo_tags WHERE todo_id = ?")
        ->execute([$_POST['id']]);
    if (!empty($_POST['tags'])) {
        $tagStmt = $pdo->prepare(
            "INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)"
        );
        foreach ($_POST['tags'] as $tagId) {
            $tagStmt->execute([$_POST['id'], $tagId]);
        }
    }

    header('Location: read.php?id=' . $_POST['id']);
    exit;
}

// Fetch data for the form
$stmt = $pdo->prepare('SELECT * FROM todos WHERE id = :id');
$stmt->execute([':id' => $_GET['id']]);
$todo = $stmt->fetch();

if (!$todo)
    die("Todo not found.");

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$allTags = $pdo->query("SELECT * FROM tags")->fetchAll();

$currentTagStmt = $pdo->prepare(
    "SELECT tag_id FROM todo_tags WHERE todo_id = ?"
);
$currentTagStmt->execute([$_GET['id']]);
$currentTags = $currentTagStmt->fetchAll(PDO::FETCH_COLUMN);

$title = 'Update Todo #' . $todo['id'];
include '_includes/header.php';
?>

<form method="POST" autocomplete="off" id="update-todo-form">
    <input type="hidden" name="id" value="<?= $todo['id'] ?>">

    <p>
        <label>Task name</label>
        <input type="text" name="name" required value="<?= htmlspecialchars($todo['name']) ?>">
    </p>

    <p>
        <label>Category</label>
        <select name="category_id">
            <option value="">-- No Category --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $todo['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label>Tags</label>
        <?php foreach ($allTags as $tag): ?>
            <label>
                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" <?= in_array($tag['id'], $currentTags) ? 'checked' : '' ?>>
                #<?= htmlspecialchars($tag['name']) ?>
            </label>
        <?php endforeach; ?>
    </p>

    <p>
        <label>Description</label>
        <textarea name="description"><?= htmlspecialchars($todo['description'] ?? '') ?></textarea>
    </p>

    <p>
        <label>
            <input type="checkbox" name="is_completed" value="1" <?= $todo['is_completed'] ? 'checked' : '' ?>>
            <strong>Mark as completed</strong>
        </label>
    </p>
</form>

<p>
    <button type="submit" form="update-todo-form">Update Todo</button>
    <a href="read.php?id=<?= $todo['id'] ?>">Cancel</a>
</p>

<?php include '_includes/footer.php'; ?>