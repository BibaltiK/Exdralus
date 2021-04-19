<?php

declare(strict_types=1);

namespace Exdrals\Exdralus;

use Exception;
use Exdrals\Exdralus\Components\Http\Request;
use Exdrals\Exdralus\Components\Router\RouteConfigLoader;
use Exdrals\Exdralus\Components\Router\Router;
use Exdrals\Exdralus\Components\Hydrator\SimpleReflectionHydrator as Hydrator;

use function error_reporting;
use function ini_set;

error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/vendor/autoload.php';

try {
    $request = new Request($_SERVER);
    $hydrator = new Hydrator();
    $routeConfig = new RouteConfigLoader(__DIR__.'/config/route', $hydrator);
    $routes = $routeConfig->getHydratedRouteConfig();
    $router = new Router($request, $routes);
    $route = $router->getRequestedRoute();
    var_dump($route);
} catch (Exception $e) {
    echo $e->getMessage();
}