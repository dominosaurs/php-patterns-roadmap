<?php

declare(strict_types=1);

use App\P05\Core\Database;
use App\P05\Core\View;

$tags = Database::getAll('SELECT * FROM tags ORDER BY name');

View::render('tags/index', 'Manage Tags', [
    'tags' => $tags,
]);
