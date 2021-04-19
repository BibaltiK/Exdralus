<?php

use Exdrals\Exdralus\Components\{
    Hydrator\SimpleReflectionHydrator as Hydrator,
    Router\RouteConfigLoader,
    Router\Router,
    Http\Request
};

return [
        Request::class => [
          'server'  //TODO Idea?
        ],

        Hydrator::class => [],

        RouteConfigLoader::class => [
            'routeConfig',
            Hydrator::class
        ],

        Router::class => [
            Request::class,
            'routes' //TODO Idea?
        ]
];
