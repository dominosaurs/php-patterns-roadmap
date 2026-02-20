<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$dbPath = __DIR__ . '/database.sqlite';
$isFirstTime = !file_exists($dbPath);

$pdo = new PDO('sqlite:' . $dbPath);

// If the database file didn't exist, run the migration silently
if ($isFirstTime) {
    require_once __DIR__ . '/migrate.php';
}
