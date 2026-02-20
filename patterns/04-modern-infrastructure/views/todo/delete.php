<?php

use App\P04\Core\View;

?>

<article>
    <p>
        Are you sure you want to delete <strong><?= View::escape($todo['name']) ?></strong>?
    </p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Todo</button>
        <a href="<?= View::url('todo/read?id='.$id) ?>">Cancel</a>
    </form>
</article>