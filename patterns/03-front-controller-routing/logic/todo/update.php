<?php

$id = $_GET['id'] ?? null;

// Handle POST request for update
if (count($_POST) > 0) {
    // 1. Update 'todos'
    $sql = 'UPDATE todos SET 
                category_id = :category_id, 
                name = :name, 
                description = :description, 
                is_completed = :is_completed,
                updated_at = CURRENT_TIMESTAMP
            WHERE id = :id';

    db_query($sql, [
        ':category_id' => ! empty($_POST['category_id']) ? $_POST['category_id'] : null,
        ':name' => $_POST['name'],
        ':description' => empty($_POST['description']) ? null : $_POST['description'],
        ':is_completed' => isset($_POST['is_completed']) ? 1 : 0,
        ':id' => $id,
    ]);

    // 2. Update tags: first delete existing, then re-insert
    db_query('DELETE FROM todo_tags WHERE todo_id = :id', [':id' => $id]);

    if (! empty($_POST['tags'])) {
        foreach ($_POST['tags'] as $tagId) {
            db_query('INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)', [$id, $tagId]);
        }
    }

    redirect("todo/read?id=$id");
}

// Fetch the existing todo
$todo = db_get_one('SELECT * FROM todos WHERE id = :id', [':id' => $id]);

if (! $todo) {
    exit('Todo not found.');
}

// Fetch categories and tags for the form
$categories = db_get_all('SELECT * FROM categories');
$tags = db_get_all('SELECT * FROM tags');

// Fetch current tags for this todo
$currentTags = db_get_all('SELECT tag_id FROM todo_tags WHERE todo_id = :id', [':id' => $id]);
$currentTagIds = array_column($currentTags, 'tag_id');

$title = 'Update Todo #'.$todo['id'];
require 'views/todo/update.php';
