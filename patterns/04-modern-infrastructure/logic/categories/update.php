<?php

use App\P04\Core\Database;
use App\P04\Core\Http;
use App\P04\Core\Request;
use App\P04\Core\View;

$id = Request::get('id');

if (Request::isPost()) {
    Database::query('UPDATE categories SET name = :name, color = :color WHERE id = :id', [
        ':name' => Request::post('name'),
        ':color' => Request::post('color'),
        ':id' => $id,
    ]);
    Http::redirect('categories/index');
}

$category = Database::getOne('SELECT * FROM categories WHERE id = :id', [':id' => $id]);

if (! $category) {
    exit('Category not found');
}

View::render('categories/update', 'Update Category', [
    'category' => $category,
]);
