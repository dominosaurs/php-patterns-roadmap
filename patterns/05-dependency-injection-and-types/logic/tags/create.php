<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

if (Request::isPost()) {
    Database::query('INSERT INTO tags (name) VALUES (:name)', [':name' => Request::post('name')]);
    Http::redirect('tags/index');
}

View::render('tags/create', 'Add New Tag');
