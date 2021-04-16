<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Router;

class RouteEntity
{
    public function __construct(
        protected string $name,
        protected string $path,
        protected string $controller,
        protected string $action,
        protected string $method,
        protected array $argument = []
    )
    {
    }

    public function hasArgument(): bool
    {
        return isset($this->argument);
    }

    public function getArgumentCount(): int
    {
        return count($this->argument);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function setController(string $controller): self
    {
        $this->controller = $controller;
        return $this;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function getArgument(): array
    {
        return $this->argument;
    }

    public function setArgument(array $argument): self
    {
        $this->argument = $argument;
        return $this;
    }
}