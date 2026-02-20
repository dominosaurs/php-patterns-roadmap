<?php

use App\P04\Core\View;

?>

<form method="POST" autocomplete="off" id="update-todo-form">
    <p>
        <label>Task name</label>
        <input type="text" name="name" value="<?= View::escape($todo['name']) ?>" required>
    </p>

    <p>
        <label>Category</label>
        <select name="category_id">
            <option value="">-- No Category --</option>
            <?php foreach ($categories as $cat) { ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $todo['category_id'] ? 'selected' : '' ?>>
                    <?= View::escape($cat['name']) ?>
                </option>
            <?php } ?>
        </select>
    </p>

    <p>
        <label>Tags</label>
        <?php foreach ($tags as $tag) { ?>
            <label>
                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" 
                    <?= in_array($tag['id'], $currentTagIds) ? 'checked' : '' ?>>
                #<?= View::escape($tag['name']) ?>
            </label>
        <?php } ?>
    </p>

    <p>
        <label>Description</label>
        <textarea name="description"><?= View::escape($todo['description']) ?></textarea>
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
    <a href="<?= View::url('todo/read?id='.$id) ?>">Cancel</a>
</p>

