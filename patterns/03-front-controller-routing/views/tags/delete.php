<?php
defined("APP_ACCESS") || die("Direct access forbidden.");
include '_includes/header.php'; ?>

<article>
    <p>Are you sure you want to delete the tag <strong>#<?= e($tag['name']) ?></strong>?</p>
    <p><small>Note: This will remove this tag from all Todos.</small></p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Tag</button>
        <a href="<?= url('tags/index') ?>">Cancel</a>
    </form>
</article>

<?php include '_includes/footer.php'; ?>