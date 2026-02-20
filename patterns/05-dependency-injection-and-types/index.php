<?php

/**
 * 🐘 PHP Patterns Roadmap
 * Pattern: 05-dependency-injection-and-types
 * Purpose: Optimized Static API with internal DI and Strict Types.
 */

declare(strict_types=1);

// 1. Load Global Autoloader from Root
require_once __DIR__.'/../../vendor/autoload.php';

// 2. Import Core Classes
use App\P05\Core\Http;
use App\P05\Core\Request;
use App\P05\Core\View;

// 3. Bootstrap Core (Manual internal DI)
// We inject the superglobals into the Request object
Request::bootstrap($_GET, $_POST, $_SERVER);

$request = Request::getInstance();
View::bootstrap($request);
Http::bootstrap(new View($request));

// 4. Middleware Pipeline
$middlewares = [
    function () {
        $uri = $_SERVER['REQUEST_URI'];
        echo '<!-- Request: '.$_SERVER['REQUEST_METHOD']." $uri -->\n";
    },
    function () {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
    },
];

foreach ($middlewares as $middleware) {
    $middleware();
}

// 5. Determine Route
$route = Request::route();

// 6. Map Route to Logic File (Whitelist)
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

// 7. Execute Logic (Static API is now ready)
require "logic/$route.php";
