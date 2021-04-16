<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Router;

use Exdrals\Exdralus\Components\Http\Request;

use function parse_url;
use function preg_match;
use function rtrim;
use function sprintf;

class Router
{
    public function __construct(
        protected Request $request,
        protected array $routes = []
    ) {
    }

    public function getRequestedRoute(): RouteEntity
    {
        $match = [];
        foreach ($this->routes as $route) {
            if (!$this->isRouteMatch($route, $match)) {
                continue;
            }
            if ($route->hasArgument()) {
                $route->setArgument($this->getAllArguments($route, array_slice($match, 2)));
            }
            return $route;
        }
        throw new RouteNotFoundException(
            sprintf('No matching route found for: <b>%s</b>', $this->getRequestPath())
        );
    }

    protected function isRouteMatch(RouteEntity $route, array &$match): bool
    {
        return (bool)preg_match(
            $this->getRegEx($route->getMethod(), $route->getPath()),
            $this->request->getServer()->getRequestMethod() . '_' . $this->getRequestPath(),
            $match
        );
    }

    protected function getRegEx(string $method, string $route): string
    {
        return '~^(' . $method . ')_' . $route . '/?$~i';
    }

    protected function getRequestPath(): string
    {
        $requestPath = parse_url($this->request->getServer()->getRequestURI(), PHP_URL_PATH);
        return rtrim($requestPath, '/') ?: $requestPath;
    }

    protected function getAllArguments(RouteEntity $route, array $match): array
    {
        $routeArgument = $route->getArgument();
        foreach ($routeArgument as &$key) {
            $key = array_shift($match);
        }
        return $routeArgument;
    }
}