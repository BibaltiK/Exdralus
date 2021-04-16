<?php

declare(strict_types=1);

namespace Exdrals\Exdralus;

use Exception;
use Exdrals\Exdralus\Components\Http\Request;
use Exdrals\Exdralus\Components\Router\RouteConfig;
use Exdrals\Exdralus\Components\Router\Router;

use function error_reporting;
use function ini_set;

error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/vendor/autoload.php';

try {
    $request = new Request($_SERVER);
    $routeConfig = new RouteConfig(__DIR__.'/config/route');
    $router = new Router($request, $routeConfig->getAllRoutesFromConfig());
    $route = $router->getRequestedRoute();
    var_dump($route);
} catch (Exception $e) {
    echo $e->getMessage();
}