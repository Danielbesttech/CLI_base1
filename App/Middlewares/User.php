<?php

namespace App\Middlewares;

use CoffeeCode\Router\Router;

class User
{
    public static function handle(Router $router): bool
    {
        $user = true;
        if ($user) {
            // var_dump($router->current());
            return true;
        }
        return false;
    }
}
