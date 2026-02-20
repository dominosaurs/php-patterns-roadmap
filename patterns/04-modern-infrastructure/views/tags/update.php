<?php

use App\P04\Core\View;

?>

<form method="POST">
    <p>
        <label>Tag name</label>
        <input type="text" name="name" value="<?= View::escape($tag['name']) ?>" required>
    </p>
    <button type="submit">Update Tag</button>
    <a href="<?= View::url('tags/index') ?>">Cancel</a>
</form>

