<?php

/**
 * 🐘 PHP Patterns Roadmap
 * Pattern: 03-front-controller-routing
 * Purpose: Centralized helper functions for DRY code.
 */

// Include the PDO connection
require_once __DIR__ . '/../../../database/pdo.php';

/**
 * Escapes HTML output.
 */
function e($string)
{
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Simplified DB Query helper.
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
 * Generates a full URL for a given route path.
 */
function url($path = '')
{
    $script_name = $_SERVER['SCRIPT_NAME'];
    $base_path = str_replace('index.php', '', $script_name);
    return $base_path . ltrim($path, '/');
}

/**
 * Redirects to a route path.
 */
function redirect($path)
{
    header("Location: " . url($path));
    exit;
}

/**
 * Checks if the current route starts with the given prefix.
 */
function is_active_route($prefix)
{
    $base_path = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
    $route_path = str_replace($base_path, '', $_SERVER['REQUEST_URI']);
    $route_path = explode('?', $route_path)[0];
    $current_route = trim($route_path, '/') ?: 'todo/index';

    return strpos($current_route, $prefix) === 0;
}
