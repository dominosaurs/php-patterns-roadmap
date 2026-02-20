<?php

namespace App\P04\Core;

class Http
{
    /**
     * Redirects to a route path.
     */
    public static function redirect($path)
    {
        header('Location: '.View::url($path));
        exit;
    }
}
