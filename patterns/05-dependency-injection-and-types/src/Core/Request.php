<?php

declare(strict_types=1);

namespace App\P05\Core;

class Request
{
    private static ?self $instance = null;

    private string $currentRoute;

    /**
     * Data is injected into the constructor
     */
    public function __construct(
        private array $get,
        private array $post,
        private array $server
    ) {
        $this->currentRoute = $this->calculateRoute();
    }

    public static function bootstrap(array $get, array $post, array $server): void
    {
        if (self::$instance === null) {
            self::$instance = new self($get, $post, $server);
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            exit('Request core not bootstrapped.');
        }

        return self::$instance;
    }

    private function calculateRoute(): string
    {
        $basePath = str_replace('index.php', '', $this->server['SCRIPT_NAME'] ?? '');
        $requestUri = $this->server['REQUEST_URI'] ?? '/';
        $routePath = str_replace($basePath, '', $requestUri);
        $routePath = explode('?', $routePath)[0];

        return trim($routePath, '/') ?: 'todo/index';
    }

    public static function route(): string
    {
        return self::getInstance()->currentRoute;
    }

    public static function get(string $key, $default = null)
    {
        return self::getInstance()->get[$key] ?? $default;
    }

    public static function post(string $key, $default = null)
    {
        return self::getInstance()->post[$key] ?? $default;
    }

    public static function isPost(): bool
    {
        return (self::getInstance()->server['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }
}
