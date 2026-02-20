<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

$id = Request::get('id');

if (Request::post('confirm')) {
    // 1. Delete pivot table entries
    Database::query('DELETE FROM todo_tags WHERE tag_id = :id', [':id' => $id]);

    // 2. Delete the tag
    Database::query('DELETE FROM tags WHERE id = :id', [':id' => $id]);

    Http::redirect('tags/index');
}

$tag = Database::getOne('SELECT name FROM tags WHERE id = :id', [':id' => $id]);

if (! $tag) {
    exit('Tag not found');
}

View::render('tags/delete', 'Delete Tag', [
    'tag' => $tag,
    'id' => $id,
]);
