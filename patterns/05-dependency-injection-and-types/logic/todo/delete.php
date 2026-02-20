<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

$id = Request::get('id');

// Confirm deletion logic
if (Request::post('confirm')) {
    // 1. Delete pivot table entries
    Database::query('DELETE FROM todo_tags WHERE todo_id = :id', [':id' => $id]);

    // 2. Delete the todo
    Database::query('DELETE FROM todos WHERE id = :id', [':id' => $id]);

    Http::redirect('todo/index');
}

// Fetch todo for confirmation info
$todo = Database::getOne('SELECT name FROM todos WHERE id = :id', [':id' => $id]);

if (! $todo) {
    exit('Todo not found.');
}

View::render('todo/delete', 'Delete Todo', [
    'todo' => $todo,
    'id' => $id,
]);
