<?php
require_once '../../database/pdo.php';

// Handle POST request
if (count($_POST) > 0) {
    // 1. Insert into 'todos'
    $statement = $pdo->prepare(
        "INSERT INTO
            todos (category_id, name, description, is_completed)
            VALUES (:category_id, :name, :description, :is_completed)"
    );

    $statement->execute([
        ':category_id' => !empty($_POST['category_id'])
            ? $_POST['category_id'] : null,
        ':name' => $_POST['name'],
        ':description' => empty($_POST['description'])
            ? null : $_POST['description'],
        ':is_completed' => isset($_POST['is_completed']) ? 1 : 0
    ]);

    $todoId = $pdo->lastInsertId();

    // 2. Insert tags into 'todo_tags' pivot table
    if (!empty($_POST['tags'])) {
        $tagStmt = $pdo->prepare(
            "INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)"
        );
        foreach ($_POST['tags'] as $tagId) {
            $tagStmt->execute([$todoId, $tagId]);
        }
    }

    header('Location: index.php');
    exit;
}

// Fetch categories for the form
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Fetch tags for the form
$tags = $pdo->query("SELECT * FROM tags")->fetchAll();

$title = 'Add New Todo';
include '_includes/header.php';
?>

<form method="POST" autocomplete="off" id="create-todo-form">
    <p>
        <label>Task name</label>
        <input type="text" name="name" required>
    </p>

    <p>
        <label>Category</label>
        <select name="category_id">
            <option value="">-- No Category --</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <label>Tags</label>
        <?php foreach ($tags as $tag): ?>
            <label>
                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>">
                #<?= htmlspecialchars($tag['name']) ?>
            </label>
        <?php endforeach; ?>
    </p>

    <p>
        <label>Description</label>
        <textarea name="description"></textarea>
    </p>

    <p>
        <label>
            <input type="checkbox" name="is_completed" value="1">
            <strong>Mark as completed</strong>
        </label>
    </p>
</form>

<p>
    <button type="submit" form="create-todo-form">Add Todo</button>
    <a href="index.php">Cancel</a>
</p>

<?php include '_includes/footer.php'; ?>