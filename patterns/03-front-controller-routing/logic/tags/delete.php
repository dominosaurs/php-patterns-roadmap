<?php
defined("APP_ACCESS") || die("Direct access forbidden.");

$id = $_GET['id'] ?? null;

if (isset($_POST['confirm'])) {
    // 1. Delete pivot table entries
    db_query("DELETE FROM todo_tags WHERE tag_id = :id", [':id' => $id]);

    // 2. Delete the tag
    db_query("DELETE FROM tags WHERE id = :id", [':id' => $id]);

    redirect('tags/index');
}

$tag = db_get_one("SELECT name FROM tags WHERE id = :id", [':id' => $id]);

if (!$tag)
    die("Tag not found");

$title = 'Delete Tag';
require 'views/tags/delete.php';
