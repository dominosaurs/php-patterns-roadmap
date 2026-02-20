<?php
defined("APP_ACCESS") || die("Direct access forbidden.");

if (count($_POST) > 0) {
    db_query("INSERT INTO tags (name) VALUES (:name)", [':name' => $_POST['name']]);
    redirect('tags/index');
}

$title = 'Add New Tag';
require 'views/tags/create.php';
