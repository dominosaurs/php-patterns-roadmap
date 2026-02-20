<?php

$id = $_GET['id'] ?? null;

if (count($_POST) > 0) {
    db_query('UPDATE categories SET name = :name, color = :color WHERE id = :id', [
        ':name' => $_POST['name'],
        ':color' => $_POST['color'],
        ':id' => $id,
    ]);
    redirect('categories/index');
}

$category = db_get_one('SELECT * FROM categories WHERE id = :id', [':id' => $id]);

if (! $category) {
    exit('Category not found');
}

$title = 'Update Category';
require 'views/categories/update.php';
