<?php

namespace App\P04\Core;

class Request
{
    private static ?string $route = null;

    /**
     * Returns the current route path (e.g., 'todo/index')
     */
    public static function route(): string
    {
        if (self::$route === null) {
            $basePath = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
            $routePath = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
            $routePath = explode('?', $routePath)[0];
            self::$route = trim($routePath, '/') ?: 'todo/index';
        }

        return self::$route;
    }

    /**
     * Get a value from $_GET
     */
    public static function get($key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Get a value from $_POST
     */
    public static function post($key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * Check if request is POST
     */
    public static function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
