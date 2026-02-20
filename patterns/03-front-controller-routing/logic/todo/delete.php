<?php
defined("APP_ACCESS") || die("Direct access forbidden.");

$id = $_GET['id'] ?? null;

// Confirm deletion logic
if (isset($_POST['confirm'])) {
    // 1. Delete pivot table entries
    db_query("DELETE FROM todo_tags WHERE todo_id = :id", [':id' => $id]);

    // 2. Delete the todo
    db_query("DELETE FROM todos WHERE id = :id", [':id' => $id]);

    redirect('todo/index');
}

// Fetch todo for confirmation info
$todo = db_get_one("SELECT name FROM todos WHERE id = :id", [':id' => $id]);

if (!$todo) {
    die("Todo not found.");
}

$title = 'Delete Todo';
require 'views/todo/delete.php';
