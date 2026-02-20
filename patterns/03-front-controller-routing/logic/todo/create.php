<?php

// Handle POST request
if (count($_POST) > 0) {
    // 1. Insert into 'todos'
    $sql = 'INSERT INTO
            todos (category_id, name, description, is_completed)
            VALUES (:category_id, :name, :description, :is_completed)';

    db_query($sql, [
        ':category_id' => ! empty($_POST['category_id']) ? $_POST['category_id'] : null,
        ':name' => $_POST['name'],
        ':description' => empty($_POST['description']) ? null : $_POST['description'],
        ':is_completed' => isset($_POST['is_completed']) ? 1 : 0,
    ]);

    global $pdo;
    $todoId = $pdo->lastInsertId();

    // 2. Insert tags into 'todo_tags' pivot table
    if (! empty($_POST['tags'])) {
        foreach ($_POST['tags'] as $tagId) {
            db_query('INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)', [$todoId, $tagId]);
        }
    }

    redirect('todo/index');
}

// Fetch categories and tags for the form
$categories = db_get_all('SELECT * FROM categories');
$tags = db_get_all('SELECT * FROM tags');

$title = 'Add New Todo';
require 'views/todo/create.php';
