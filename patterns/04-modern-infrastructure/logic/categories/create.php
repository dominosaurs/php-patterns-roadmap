<?php

use App\P04\Core\Database;
use App\P04\Core\Http;
use App\P04\Core\Request;
use App\P04\Core\View;

if (Request::isPost()) {
    Database::query('INSERT INTO categories (name, color) VALUES (:name, :color)', [
        ':name' => Request::post('name'),
        ':color' => Request::post('color'),
    ]);
    Http::redirect('categories/index');
}

View::render('categories/create', 'Add New Category');
