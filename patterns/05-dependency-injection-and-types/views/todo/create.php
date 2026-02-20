<?php

use App\P04\Core\View;

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
            <?php foreach ($categories as $cat) { ?>
                <option value="<?= $cat['id'] ?>"><?= View::escape($cat['name']) ?></option>
            <?php } ?>
        </select>
    </p>

    <p>
        <label>Tags</label>
        <?php foreach ($tags as $tag) { ?>
            <label>
                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>">
                #<?= View::escape($tag['name']) ?>
            </label>
        <?php } ?>
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
    <a href="<?= View::url('todo/index') ?>">Cancel</a>
</p>