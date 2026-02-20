<?php

use App\P04\Core\Database;
use App\P04\Core\View;

$categories = Database::getAll('SELECT * FROM categories ORDER BY name');

View::render('categories/index', 'Manage Categories', [
    'categories' => $categories,
]);
