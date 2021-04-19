<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Router;

use Exdrals\Exdralus\Components\Config\ConfigLoader;
use Exdrals\Exdralus\Components\Hydrator\SimpleReflectionHydrator as Hydrator;

class RouteConfigLoader extends ConfigLoader
{
    public function __construct(
        protected string $configSource,
        protected Hydrator $hydrator)
    {
        parent::__construct($configSource);
    }

    public function getHydratedRouteConfig()
    {
        $convertRoutes = [];
        foreach ($this->getAllRoutesFromConfig() as $route) {
            $convertRoutes[] = $this->hydrator->hydrate($route,new RouteEntity());
        }
        return $convertRoutes;
    }
}