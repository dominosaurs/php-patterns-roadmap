<?php

/**
 * 🐘 PHP Patterns Roadmap
 * Pattern: 04-modern-infrastructure
 * Purpose: Unified infrastructure (Autoloading + Singleton + Middleware).
 */

// 1. Load Global Autoloader from Root
require_once __DIR__.'/../../vendor/autoload.php';

// Import Core Classes
use App\P04\Core\Request;
use App\P04\Core\View;

// 2. Middleware Pipeline
$middlewares = [
    function () {
        // Request Logger
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];
        echo "<!-- Request: $method $uri -->\n";
    },
    function () {
        // Security Headers
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
    },
];

foreach ($middlewares as $middleware) {
    $middleware();
}

// 3. Determine Route using Request Helper
$route = Request::route();

// 4. Map Route to Logic File (Whitelist)
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
    exit('Route not found: '.View::escape($route));
}

// 5. Execute Logic (Database Singleton initializes on demand)
require "logic/$route.php";
