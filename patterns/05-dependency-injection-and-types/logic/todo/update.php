<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

$id = Request::get('id');

// Handle POST request for update
if (Request::isPost()) {
    // 1. Update 'todos'
    $sql = 'UPDATE todos SET 
                category_id = :category_id, 
                name = :name, 
                description = :description, 
                is_completed = :is_completed,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id';

    Database::query($sql, [
        ':category_id' => Request::post('category_id') ?: null,
        ':name' => Request::post('name'),
        ':description' => Request::post('description') ?: null,
        ':is_completed' => Request::post('is_completed') ? 1 : 0,
        ':id' => $id,
    ]);

    // 2. Update tags: first delete existing, then re-insert
    Database::query('DELETE FROM todo_tags WHERE todo_id = :id', [':id' => $id]);

    $tags = Request::post('tags');
    if (! empty($tags)) {
        foreach ($tags as $tagId) {
            Database::query('INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)', [$id, $tagId]);
        }
    }

    Http::redirect("todo/read?id=$id");
}

// Fetch the existing todo
$todo = Database::getOne('SELECT * FROM todos WHERE id = :id', [':id' => $id]);

if (! $todo) {
    exit('Todo not found.');
}

// Fetch categories and tags for the form
$categories = Database::getAll('SELECT * FROM categories');
$tags = Database::getAll('SELECT * FROM tags');

// Fetch current tags for this todo
$currentTags = Database::getAll('SELECT tag_id FROM todo_tags WHERE todo_id = :id', [':id' => $id]);
$currentTagIds = array_column($currentTags, 'tag_id');

View::render('todo/update', 'Update Todo #'.$todo['id'], [
    'todo' => $todo,
    'categories' => $categories,
    'tags' => $tags,
    'currentTagIds' => $currentTagIds,
    'id' => $id,
]);
