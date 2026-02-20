<?php
require_once '_includes/functions.php';

$id = $_GET['id'] ?? null;

// Handle POST request for update
if (count($_POST) > 0) {
    // 1. Update 'todos'
    $sql = 'UPDATE todos SET 
                category_id = :category_id, 
                name = :name, 
                description = :description, 
                is_completed = :is_completed,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id';

    db_query($sql, [
        ':category_id' => ! empty($_POST['category_id']) ? $_POST['category_id'] : null,
        ':name' => $_POST['name'],
        ':description' => empty($_POST['description']) ? null : $_POST['description'],
        ':is_completed' => isset($_POST['is_completed']) ? 1 : 0,
        ':id' => $id,
    ]);

    // 2. Update tags: first delete existing, then re-insert
    db_query('DELETE FROM todo_tags WHERE todo_id = :id', [':id' => $id]);

    if (! empty($_POST['tags'])) {
        foreach ($_POST['tags'] as $tagId) {
            db_query('INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)', [$id, $tagId]);
        }
    }

    redirect("read.php?id=$id");
}

// Fetch the existing todo
$todo = db_get_one('SELECT * FROM todos WHERE id = :id', [':id' => $id]);

if (! $todo) {
    exit('Todo not found.');
}

// Fetch categories and tags for the form
$categories = db_get_all('SELECT * FROM categories');
$tags = db_get_all('SELECT * FROM tags');

// Fetch current tags for this todo
$currentTags = db_get_all('SELECT tag_id FROM todo_tags WHERE todo_id = :id', [':id' => $id]);
$currentTagIds = array_column($currentTags, 'tag_id');

$title = 'Update Todo #'.$todo['id'];
include '_includes/header.php';
?>

<form method="POST" autocomplete="off" id="update-todo-form">
    <p>
        <label>Task name</label>
        <input type="text" name="name" value="<?= e($todo['name']) ?>" required>
    </p>

    <p>
        <label>Category</label>
        <select name="category_id">
            <option value="">-- No Category --</option>
            <?php foreach ($categories as $cat) { ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $todo['category_id'] ? 'selected' : '' ?>>
                    <?= e($cat['name']) ?>
                </option>
            <?php } ?>
        </select>
    </p>

    <p>
        <label>Tags</label>
        <?php foreach ($tags as $tag) { ?>
            <label>
                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" <?= in_array($tag['id'], $currentTagIds) ? 'checked' : '' ?>>
                #<?= e($tag['name']) ?>
            </label>
        <?php } ?>
    </p>

    <p>
        <label>Description</label>
        <textarea name="description"><?= e($todo['description']) ?></textarea>
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
    <a href="read.php?id=<?= $id ?>">Cancel</a>
</p>

<?php include '_includes/footer.php'; ?>