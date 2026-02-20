<?php include '_includes/header.php'; ?>

<form method="POST">
    <p>
        <label>Category name</label>
        <input type="text" name="name" required>
    </p>
    <p>
        <label>Color (Hex)</label>
        <input type="color" name="color" value="#000000">
    </p>
    <button type="submit">Save Category</button>
    <a href="<?= url('categories/index') ?>">Cancel</a>
</form>

<?php include '_includes/footer.php'; ?>