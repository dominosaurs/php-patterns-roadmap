<?php

use App\P04\Core\View;

?>

<form method="POST">
    <p>
        <label>Category name</label>
        <input type="text" name="name" value="<?= View::escape($category['name']) ?>" required>
    </p>
    <p>
        <label>Color (Hex)</label>
        <input type="color" name="color" value="<?= View::escape($category['color'] ?? '#000000') ?>">
    </p>
    <button type="submit">Update Category</button>
    <a href="<?= View::url('categories/index') ?>">Cancel</a>
</form>