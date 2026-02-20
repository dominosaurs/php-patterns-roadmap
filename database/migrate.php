<?php

/**
 * Database Migration & Seeding Script
 *
 * Can be run manually via CLI: php database/migrate.php
 * Or called automatically by pdo.php during first-time setup.
 */

require_once __DIR__.'/pdo.php';

// Only show prompt and CLI check if executed directly (not included by pdo.php)
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    if (php_sapi_name() !== 'cli') {
        exit("This script can only be run from the command line for manual resets.\n");
    }

    echo "⚠️  WARNING: This will DELETE all existing data and reset the database.\n";
    echo "Are you sure? Type 'yes' to continue: ";
    $handle = fopen('php://stdin', 'r');
    if (trim(fgets($handle)) !== 'yes') {
        exit("Aborting migration.\n");
    }
}

// Logic starts here
try {
    echo php_sapi_name() === 'cli' ? "Cleaning up old tables...\n" : '';
    $pdo->exec('DROP TABLE IF EXISTS todo_tags');
    $pdo->exec('DROP TABLE IF EXISTS tags');
    $pdo->exec('DROP TABLE IF EXISTS todos');
    $pdo->exec('DROP TABLE IF EXISTS categories');

    echo php_sapi_name() === 'cli' ? "Creating tables...\n" : '';
    $pdo->exec('CREATE TABLE categories (id INTEGER PRIMARY KEY, name TEXT NOT NULL, color TEXT)');
    $pdo->exec('CREATE TABLE tags (id INTEGER PRIMARY KEY, name TEXT NOT NULL UNIQUE)');
    $pdo->exec('CREATE TABLE todos (
        id INTEGER PRIMARY KEY,
        category_id INTEGER,
        name TEXT NOT NULL,
        description TEXT,
        is_completed BOOLEAN NOT NULL DEFAULT FALSE,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
    )');
    $pdo->exec('CREATE TABLE todo_tags (
        todo_id INTEGER NOT NULL,
        tag_id INTEGER NOT NULL,
        PRIMARY KEY (todo_id, tag_id),
        FOREIGN KEY (todo_id) REFERENCES todos(id) ON DELETE CASCADE,
        FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
    )');

    echo php_sapi_name() === 'cli' ? "Seeding initial data...\n" : '';

    // Seed Categories
    $stmtCat = $pdo->prepare('INSERT INTO categories (name, color) VALUES (?, ?)');
    foreach ([['Work', '#007bff'], ['Personal', '#28a745'], ['Shopping', '#ffc107'], ['Health', '#dc3545']] as $cat) {
        $stmtCat->execute($cat);
    }

    // Seed Tags
    $stmtTag = $pdo->prepare('INSERT INTO tags (name) VALUES (?)');
    foreach (['Urgent', 'Low Priority', 'Idea', 'Review'] as $tag) {
        $stmtTag->execute([$tag]);
    }

    // Seed Initial Todos
    $stmtTodo = $pdo->prepare('INSERT INTO todos (category_id, name, description, is_completed) VALUES (?, ?, ?, ?)');
    foreach ([
        [1, 'Learn Basic PHP', 'Understand variables, loops, and conditions.', 1],
        [2, 'Buy groceries', 'Milk, Bread, and Coffee.', 0],
        [1, 'Build a CRUD App', 'Create, Read, Update, and Delete data using PDO.', 0],
        [4, 'Morning Jogging', 'Run for 30 minutes in the park.', 1],
        [null, 'Read a book', 'Finish at least 2 chapters today.', 0],
    ] as $todo) {
        $stmtTodo->execute($todo);
    }

    // Seed Pivot
    $stmtLink = $pdo->prepare('INSERT INTO todo_tags (todo_id, tag_id) VALUES (?, ?)');
    foreach ([[1, 1], [1, 4], [3, 1], [2, 3]] as $link) {
        $stmtLink->execute($link);
    }

    if (php_sapi_name() === 'cli') {
        echo "✅ Database migrated and seeded successfully!\n";
    }
} catch (Exception $e) {
    exit('Migration failed: '.$e->getMessage());
}
