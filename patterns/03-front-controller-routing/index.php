<?php

/**
 * 🐘 PHP Patterns Roadmap
 * Pattern: 03-front-controller-routing
 * Purpose: Single entry point with Pretty URLs.
 */

// 1. Load Helpers
require_once '_includes/functions.php';

// 2. Determine Route from REQUEST_URI
$request_uri = $_SERVER['REQUEST_URI'];
$script_name = $_SERVER['SCRIPT_NAME']; // e.g., /patterns/03-front-controller-routing/index.php

// Get the base directory where index.php resides
$base_path = str_replace('index.php', '', $script_name);

// Extract the route by removing the base path from the URI
$route_path = str_replace($base_path, '', $request_uri);

// Remove query strings (like ?id=1) for route matching
$route_parts = preg_split('/[?&]/', $route_path);
$route_path = $route_parts[0];

// Final route (default to todo/index)
$route = trim($route_path, '/') ?: 'todo/index';

// 3. Map Route to Logic File
$allowed_routes = [
    'todo/index',
    'todo/create',
    'todo/read',
    'todo/update',
    'todo/delete',
    'categories/index',
    'categories/create',
    'categories/update',
    'categories/delete',
    'tags/index',
    'tags/create',
    'tags/update',
    'tags/delete',
];

if (! in_array($route, $allowed_routes)) {
    http_response_code(404);
    exit('Route not found: '.e($route).'<br><small>Note: Pretty URLs might require a router script if using php -S from root.</small>');
}

// 4. Execute Logic
require "logic/$route.php";
