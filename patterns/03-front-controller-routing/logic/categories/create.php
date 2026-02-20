<?php

if (count($_POST) > 0) {
    db_query('INSERT INTO categories (name, color) VALUES (:name, :color)', [
        ':name' => $_POST['name'],
        ':color' => $_POST['color'],
    ]);
    redirect('categories/index');
}

$title = 'Add New Category';
require 'views/categories/create.php';
