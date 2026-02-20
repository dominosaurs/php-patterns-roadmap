<?php

use App\P04\Core\View;

?>

<article>
    <p>Are you sure you want to delete the category <strong><?= View::escape($category['name']) ?></strong>?</p>
    <p><small>Note: Todos in this category will become uncategorized.</small></p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Category</button>
        <a href="<?= View::url('categories/index') ?>">Cancel</a>
    </form>
</article>