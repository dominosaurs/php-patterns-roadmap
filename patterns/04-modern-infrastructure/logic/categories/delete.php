<?php

use App\P04\Core\Database;
use App\P04\Core\Http;
use App\P04\Core\Request;
use App\P04\Core\View;

$id = Request::get('id');

if (Request::post('confirm')) {
    // 1. Unset category from todos
    Database::query('UPDATE todos SET category_id = NULL WHERE category_id = :id', [':id' => $id]);

    // 2. Delete category
    Database::query('DELETE FROM categories WHERE id = :id', [':id' => $id]);

    Http::redirect('categories/index');
}

$category = Database::getOne('SELECT name FROM categories WHERE id = :id', [':id' => $id]);

if (! $category) {
    exit('Category not found');
}

View::render('categories/delete', 'Delete Category', [
    'category' => $category,
]);
