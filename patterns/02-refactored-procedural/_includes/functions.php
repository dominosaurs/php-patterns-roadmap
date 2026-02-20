<?php

/**
 * 🐘 PHP Patterns Roadmap
 * Pattern: 02-refactored-procedural
 * Purpose: Centralized helper functions for DRY code.
 */

// Include the PDO connection
require_once __DIR__ . '/../../../database/pdo.php';

/**
 * Escapes HTML output.
 * Short name 'e' for brevity in views.
 */
function e($string)
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Simplified DB Query helper.
 * Executes a prepared statement and returns the statement object.
 */
function db_query($sql, $params = [])
{
    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

/**
 * Executes a query and fetches all rows.
 */
function db_get_all($sql, $params = [])
{
    return db_query($sql, $params)->fetchAll();
}

/**
 * Executes a query and fetches a single row.
 */
function db_get_one($sql, $params = [])
{
    return db_query($sql, $params)->fetch();
}

/**
 * Redirects to a relative URL and exits.
 */
function redirect($url)
{
    header("Location: $url");
    exit;
}
