<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Router;

use function rtrim;
use function glob;
use function array_merge;

class RouteConfig
{
    public function __construct(
        protected string $routeConfigDir
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

        return $this->mapArrayToObject($routes);
    }

    private function mapArrayToObject(array $routes): array
    {
        $convertRoutes = [];
        foreach ($routes as $route => $element) {
            $convertRoutes[] = new RouteEntity(
                $route,
                $element['path'],
                $element['controller'],
                $element['action'],
                $element['method'],
                $element['params'] ?? []
            );
            if (isset($element['params'])) {
                $convertRoutes[array_key_last($convertRoutes)]->setArgument($this->switchValueToArrayKeyName($element['params']));
            }
        }
        return $convertRoutes;
    }

    private function switchValueToArrayKeyName(array $argument): array
    {
        $convertArgument = [];
        foreach ($argument as $argumentName) {
            $convertArgument[$argumentName] = null;
        }
        return $convertArgument;
    }
}