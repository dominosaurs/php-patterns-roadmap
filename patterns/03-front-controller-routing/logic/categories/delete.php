<?php
defined("APP_ACCESS") || die("Direct access forbidden.");

$id = $_GET['id'] ?? null;

if (isset($_POST['confirm'])) {
    // 1. Unset category from todos
    db_query("UPDATE todos SET category_id = NULL WHERE category_id = :id", [':id' => $id]);

    // 2. Delete category
    db_query("DELETE FROM categories WHERE id = :id", [':id' => $id]);

    redirect('categories/index');
}

$category = db_get_one("SELECT name FROM categories WHERE id = :id", [':id' => $id]);

if (!$category)
    die("Category not found");

$title = 'Delete Category';
require 'views/categories/delete.php';
