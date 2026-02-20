<?php

use App\P04\Core\View;

?>

<form method="POST">
    <p>
        <label>Tag name</label>
        <input type="text" name="name" placeholder="e.g. urgent" required>
    </p>
    <button type="submit">Save Tag</button>
    <a href="<?= View::url('tags/index') ?>">Cancel</a>
</form>

