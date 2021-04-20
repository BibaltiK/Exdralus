<?php

declare(strict_types=1);

namespace Exdrals\Exdralus;

use Exception;
use Exdrals\Exdralus\Components\Config\ConfigLoader;
use Exdrals\Exdralus\Components\Dependency\Container;
use Exdrals\Exdralus\Components\Router\RouteConfigLoader;
use Exdrals\Exdralus\Components\Router\Router;

use function error_reporting;
use function ini_set;

error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/vendor/autoload.php';

try {
    $dependencyConfigLoader = new ConfigLoader(__DIR__ . '/config/dependency');
    $dependency = new Container($dependencyConfigLoader->getAllRoutesFromConfig());
    $dependency->setParam('server', $_SERVER);
    $dependency->setParam('routeConfig', __DIR__ . '/config/route');
    $dependency->setParam('routes',$dependency->get(RouteConfigLoader::class)->getHydratedRouteConfig());

    $route = $dependency->get(Router::class)->getRequestedRoute();
    $dependency->get($route->getController())->process();
} catch (Exception $e) {
    echo $e->getMessage();
}