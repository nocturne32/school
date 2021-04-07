<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;


    public static function createRouter(): RouteList
    {
        $router = new RouteList;
        $router->add(self::createRouterAdmin());
        $router->add(self::createRouterFront());

        return $router;
    }

    private static function createRouterAdmin(): RouteList
    {
        $router = new RouteList('Admin');

        $router->addRoute('admin/<presenter>[/<id \d+>]/<action>', 'Homepage:default');

        return $router;
    }

    private static function createRouterFront(): RouteList
    {
        $router = new RouteList('Front');

        $router->addRoute('<presenter>[/<id \d+>]/<action>', 'Homepage:default');

        return $router;
    }
}
