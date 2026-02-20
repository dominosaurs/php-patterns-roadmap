<?php

$categories = db_get_all("SELECT * FROM categories ORDER BY name");

$title = 'Manage Categories';
require 'views/categories/index.php';
