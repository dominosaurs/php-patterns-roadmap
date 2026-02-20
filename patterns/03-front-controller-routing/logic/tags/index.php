<?php
defined("APP_ACCESS") || die("Direct access forbidden.");

$tags = db_get_all("SELECT * FROM tags ORDER BY name");

$title = 'Manage Tags';
require 'views/tags/index.php';
