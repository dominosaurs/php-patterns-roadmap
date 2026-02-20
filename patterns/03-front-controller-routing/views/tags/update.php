<?php
defined("APP_ACCESS") || die("Direct access forbidden.");
include '_includes/header.php'; ?>

<form method="POST">
    <p>
        <label>Tag name</label>
        <input type="text" name="name" value="<?= e($tag['name']) ?>" required>
    </p>
    <button type="submit">Update Tag</button>
    <a href="<?= url('tags/index') ?>">Cancel</a>
</form>

<?php include '_includes/footer.php'; ?>