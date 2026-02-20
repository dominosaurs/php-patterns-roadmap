<?php
defined("APP_ACCESS") || die("Direct access forbidden.");
include '_includes/header.php'; ?>

<form method="POST">
    <p>
        <label>Category name</label>
        <input type="text" name="name" value="<?= e($category['name']) ?>" required>
    </p>
    <p>
        <label>Color (Hex)</label>
        <input type="color" name="color" value="<?= e($category['color'] ?? '#000000') ?>">
    </p>
    <button type="submit">Update Category</button>
    <a href="<?= url('categories/index') ?>">Cancel</a>
</form>

<?php include '_includes/footer.php'; ?>