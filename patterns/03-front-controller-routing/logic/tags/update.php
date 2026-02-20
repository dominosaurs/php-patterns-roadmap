<?php

$id = $_GET['id'] ?? null;

if (count($_POST) > 0) {
    db_query('UPDATE tags SET name = :name WHERE id = :id', [
        ':name' => $_POST['name'],
        ':id' => $id,
    ]);
    redirect('tags/index');
}

$tag = db_get_one('SELECT * FROM tags WHERE id = :id', [':id' => $id]);

if (! $tag) {
    exit('Tag not found');
}

$title = 'Update Tag';
require 'views/tags/update.php';
