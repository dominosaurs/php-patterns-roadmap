<?php

use App\P04\Core\Database;
use App\P04\Core\Http;
use App\P04\Core\Request;
use App\P04\Core\View;

if (Request::isPost()) {
    Database::query('INSERT INTO tags (name) VALUES (:name)', [':name' => Request::post('name')]);
    Http::redirect('tags/index');
}

View::render('tags/create', 'Add New Tag');
