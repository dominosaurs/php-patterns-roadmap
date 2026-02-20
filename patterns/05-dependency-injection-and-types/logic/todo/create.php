<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

// Handle POST request
if (Request::isPost()) {
    // 1. Insert into 'todos'
    $sql = 'INSERT INTO
            todos (category_id, name, description, is_completed)
            VALUES (:category_id, :name, :description, :is_completed)';

    Database::query($sql, [
        ':category_id' => Request::post('category_id') ?: null,
        ':name' => Request::post('name'),
        ':description' => Request::post('description') ?: null,
        ':is_completed' => Request::post('is_completed') ? 1 : 0,
    ]);

    $todoId = Database::lastInsertId();

    // 2. Insert tags into 'todo_tags' pivot table
    $tags = Request::post('tags');
    if (! empty($tags)) {
        foreach ($tags as $tagId) {
            Database::query('INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)', [$todoId, $tagId]);
        }
    }

    Http::redirect('todo/index');
}

// Fetch categories and tags for the form
$categories = Database::getAll('SELECT * FROM categories');
$tags = Database::getAll('SELECT * FROM tags');

View::render('todo/create', 'Add New Todo', [
    'categories' => $categories,
    'tags' => $tags,
]);
