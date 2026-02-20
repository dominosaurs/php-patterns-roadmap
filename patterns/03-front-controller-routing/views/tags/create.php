<?php include '_includes/header.php'; ?>

<form method="POST">
    <p>
        <label>Tag name</label>
        <input type="text" name="name" placeholder="e.g. urgent" required>
    </p>
    <button type="submit">Save Tag</button>
    <a href="<?= url('tags/index') ?>">Cancel</a>
</form>

<?php include '_includes/footer.php'; ?>