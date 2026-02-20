<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

$id = Request::get('id');

if (Request::isPost()) {
    Database::query('UPDATE tags SET name = :name WHERE id = :id', [
        ':name' => Request::post('name'),
        ':id' => $id,
    ]);
    Http::redirect('tags/index');
}

$tag = Database::getOne('SELECT * FROM tags WHERE id = :id', [':id' => $id]);

if (! $tag) {
    exit('Tag not found');
}

View::render('tags/update', 'Update Tag', [
    'tag' => $tag,
]);
