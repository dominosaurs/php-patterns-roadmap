<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\View;

$categories = Database::getAll('SELECT * FROM categories ORDER BY name');

View::render('categories/index', 'Manage Categories', [
    'categories' => $categories,
]);
