<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Router;

use Exdrals\Exdralus\Components\Http\Request;

use InvalidArgumentException;

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
        $requestPath = $this->getRequestPath();
        foreach ($this->routes as $route) {
            if (!$this->isRouteMatch($route, $requestPath, $match )) {
                continue;
            }
            if ($route->getArgument() !== null) {
                $route->setArgument($this->getArgumentsFromRouteMatch($route, array_slice($match, 2)));
            }
            return $route;
        }
        throw new RouteNotFoundException(
            sprintf('No matching route found for: <b>%s</b>', $requestPath)
        );
    }

    protected function isRouteMatch(RouteEntity $route, string $requestPath, array &$match): bool
    {
        return (bool)preg_match(
            $this->getRegEx($route->getMethod(), $route->getPath()),
            $this->request->getServer()->getRequestMethod() . '_' . $requestPath,
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

    protected function getArgumentsFromRouteMatch(RouteEntity $route, array $match): array
    {
        $routeArgument = $route->getArgument();
        foreach ($routeArgument as &$value) {
            if (null === $value = array_shift($match))
            {
                throw new InvalidArgumentException(
                    sprintf('Missing argument for Route: <b>%s</b>', $route->getPath())
                );
            }
        }
        return $routeArgument;
    }
}