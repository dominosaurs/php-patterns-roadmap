<?php

declare(strict_types=1);

namespace App\P05\Core;

class View
{
    private static ?self $instance = null;

    /**
     * Use Constructor Property Promotion for Internal DI
     */
    public function __construct(
        private Request $request
    ) {}

    public static function bootstrap(Request $request): void
    {
        if (self::$instance === null) {
            self::$instance = new self($request);
        }
    }

    private static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self(Request::getInstance());
        }

        return self::$instance;
    }

    public static function escape(?string $string): string
    {
        return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
    }

    public static function url(string $path = ''): string
    {
        $basePath = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

        return $basePath.ltrim($path, '/');
    }

    public static function isActiveRoute(string $prefix): bool
    {
        return strpos(self::getInstance()->request->route(), $prefix) === 0;
    }

    public static function render(string $viewPath, string $title = 'PHP Patterns', array $data = []): void
    {
        // Extract data to make variables available in the view
        extract($data);

        ob_start();
        require __DIR__.'/../../_includes/header.php';
        require __DIR__."/../../views/$viewPath.php";
        require __DIR__.'/../../_includes/footer.php';
        echo ob_get_clean();
    }
}
