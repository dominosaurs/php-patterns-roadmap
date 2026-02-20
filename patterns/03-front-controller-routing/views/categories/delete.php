<?php
defined("APP_ACCESS") || die("Direct access forbidden.");
include '_includes/header.php'; ?>

<article>
    <p>Are you sure you want to delete the category <strong><?= e($category['name']) ?></strong>?</p>
    <p><small>Note: Todos in this category will become uncategorized.</small></p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Category</button>
        <a href="<?= url('categories/index') ?>">Cancel</a>
    </form>
</article>

<?php include '_includes/footer.php'; ?>