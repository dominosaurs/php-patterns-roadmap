<?php

use App\P04\Core\View;

?>

<article>
    <p>Are you sure you want to delete the tag <strong>#<?= View::escape($tag['name']) ?></strong>?</p>
    <p><small>Note: This will remove this tag from all Todos.</small></p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Tag</button>
        <a href="<?= View::url('tags/index') ?>">Cancel</a>
    </form>
</article>

