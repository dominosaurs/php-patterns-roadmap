<?php

use App\P04\Core\Database;
use App\P04\Core\View;

// Fetch todos with category and tags
$sql = 'SELECT 
            todos.*, 
            categories.name as category_name, 
            categories.color as category_color,
            GROUP_CONCAT(tags.name) as tag_names
        FROM todos 
        LEFT JOIN categories ON todos.category_id = categories.id 
        LEFT JOIN todo_tags ON todos.id = todo_tags.todo_id
        LEFT JOIN tags ON todo_tags.tag_id = tags.id
        GROUP BY todos.id
        ORDER BY todos.is_completed ASC, todos.created_at DESC';

$todos = Database::getAll($sql);

View::render('todo/index', 'Todo List', [
    'todos' => $todos,
]);
