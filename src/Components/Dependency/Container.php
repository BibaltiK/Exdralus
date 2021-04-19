<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Dependency;

use Psr\Container\ContainerInterface;

use function array_key_exists;
use function array_map;


class Container implements ContainerInterface
{
    protected array $objects = [];
    protected array $params = [];

    public function __construct(
        protected array $dependencies
    ) {
    }

    public function set(string $class, object $instance): void
    {
        $this->objects[$class] = $instance;
    }

    public function setParam(string $keyName, mixed $param): void
    {
        $this->params[$keyName] = $param;
    }

    public function get($id): object
    {
        if ( (isset($this->objects[$id])) || array_key_exists($id, $this->objects)) {
            return $this->objects[$id];
        }

        if (!$this->has($id)) {
            throw new DependencyNotFoundException(sprintf('Dependency <b>%s</b> does not exist', $id));
        }

        $params = [];
        foreach ($this->dependencies[$id] as $dependency ) {
            $params[] = class_exists($dependency) ? $this->get($dependency) : $this->getParam($dependency);
        }

        return $this->objects[$id] = new $id(...$params);
    }

    public function has($id): bool
    {
        return isset($this->dependencies[$id]) || array_key_exists($id, $this->dependencies);
    }

    protected function getParam(string $param): mixed
    {
        if (isset($this->params[$param]) || array_key_exists($param, $this->params)) {
            return $this->params[$param];
        }
        throw new DependencyNotFoundException(sprintf('Dependency <b>%s</b> does not exist', $param));
    }
}