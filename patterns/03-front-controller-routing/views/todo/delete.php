<?php include '_includes/header.php'; ?>

<article>
    <p>
        Are you sure you want to delete <strong><?= e($todo['name']) ?></strong>?
    </p>

    <form method="POST">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Delete Todo</button>
        <a href="<?= url('todo/read?id='.$id) ?>">Cancel</a>
    </form>
</article>

<?php include '_includes/footer.php'; ?>