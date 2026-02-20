<?php

$id = $_GET['id'] ?? null;

// Fetch Todo with Category
$todo = db_get_one(
    "SELECT
        todos.*,
        categories.name as category_name,
        categories.color as category_color 
    FROM todos 
    LEFT JOIN categories ON todos.category_id = categories.id 
    WHERE todos.id = :id",
    [':id' => $id]
);

if (!$todo) {
    die("Todo not found.");
}

// Fetch Tags for this Todo
$tags = db_get_all(
    "SELECT tags.name
    FROM tags
    JOIN todo_tags ON tags.id = todo_tags.tag_id
    WHERE todo_tags.todo_id = :id",
    [':id' => $id]
);

$title = 'Todo Details';
require 'views/todo/read.php';
