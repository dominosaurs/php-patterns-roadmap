<?php

use App\P04\Core\Database;
use App\P04\Core\View;

$tags = Database::getAll('SELECT * FROM tags ORDER BY name');

View::render('tags/index', 'Manage Tags', [
    'tags' => $tags,
]);
