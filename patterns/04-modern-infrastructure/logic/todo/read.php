<?php

use App\P04\Core\Database;
use App\P04\Core\Request;
use App\P04\Core\View;

$id = Request::get('id');

// Fetch Todo with Category
$todo = Database::getOne(
    'SELECT
        todos.*,
        categories.name as category_name,
        categories.color as category_color 
    FROM todos 
    LEFT JOIN categories ON todos.category_id = categories.id 
    WHERE todos.id = :id',
    [':id' => $id]
);

if (! $todo) {
    exit('Todo not found.');
}

// Fetch Tags for this Todo
$tags = Database::getAll(
    'SELECT tags.name
    FROM tags
    JOIN todo_tags ON tags.id = todo_tags.tag_id
    WHERE todo_tags.todo_id = :id',
    [':id' => $id]
);

View::render('todo/read', 'Todo Details', [
    'todo' => $todo,
    'tags' => $tags,
]);
