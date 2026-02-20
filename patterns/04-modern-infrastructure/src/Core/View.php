<?php

namespace App\P04\Core;

class View
{
    private static ?string $basePath = null;

    /**
     * Gets the base path of the current pattern.
     */
    private static function getBasePath(): string
    {
        if (self::$basePath === null) {
            self::$basePath = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        }

        return self::$basePath;
    }

    /**
     * Escapes HTML output.
     */
    public static function escape($string)
    {
        return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
    }

    /**
     * Generates a full URL for a given route path.
     */
    public static function url($path = '')
    {
        return self::getBasePath().ltrim($path, '/');
    }

    /**
     * Checks if the current route starts with the given prefix.
     */
    public static function isActiveRoute($prefix)
    {
        return strpos(Request::route(), $prefix) === 0;
    }

    /**
     * Standardized render method.
     */
    public static function render($viewPath, $title = 'PHP Patterns', $data = [])
    {
        // Extract data to make variables available in the view
        extract($data);

        ob_start();

        // 1. Include Header (uses $title)
        require __DIR__.'/../../_includes/header.php';

        // 2. Include the specific view content
        require __DIR__."/../../views/$viewPath.php";

        // 3. Include Footer
        require __DIR__.'/../../_includes/footer.php';

        echo ob_get_clean();
    }
}
