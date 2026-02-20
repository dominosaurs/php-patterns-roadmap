<?php

declare(strict_types=1);

namespace App\P05\Core;

class Http
{
    private static ?self $instance = null;

    public function __construct(
        private View $view
    ) {}

    public static function bootstrap(View $view): void
    {
        if (self::$instance === null) {
            self::$instance = new self($view);
        }
    }

    private static function getInstance(): self
    {
        if (self::$instance === null) {
            exit('Http core not bootstrapped.');
        }

        return self::$instance;
    }

    public static function redirect(string $path): void
    {
        header('Location: '.self::getInstance()->view->url($path));
        exit;
    }
}
