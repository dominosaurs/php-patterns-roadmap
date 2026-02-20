<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

if (Request::isPost()) {
    Database::query('INSERT INTO categories (name, color) VALUES (:name, :color)', [
        ':name' => Request::post('name'),
        ':color' => Request::post('color'),
    ]);
    Http::redirect('categories/index');
}

View::render('categories/create', 'Add New Category');
