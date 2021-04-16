<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Router;

use Exdrals\Exdralus\Components\Hydrator\SimpleRelectionHydrator as Hydrator;

use function rtrim;
use function glob;
use function array_merge;

class RouteConfig
{
    public function __construct(
        protected string $routeConfigDir,
        protected Hydrator $hydrator
    )
    {
        $this->routeConfigDir = rtrim($routeConfigDir, '/');
    }

    public function getAllRoutesFromConfig(): array
    {
        //TODO read from single File oder Directory
        $routes = [];

        foreach (glob($this->routeConfigDir.'/*.php') as $routeConfigFile)
        {
            $routes = array_merge($routes, require_once $routeConfigFile);
        }

        return $this->hydrateArray($routes);
    }

    private function hydrateArray(array $routes): array
    {
        $convertRoutes = [];
        foreach ($routes as $route) {
            $convertRoutes[] = $this->hydrator->hydrate($route,new RouteEntity());
        }
        return $convertRoutes;
    }
}