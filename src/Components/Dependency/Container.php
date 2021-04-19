<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Dependency;

use Psr\Container\ContainerInterface;

use function array_key_exists;
use function array_map;


class Container implements ContainerInterface
{
    protected array $objects = [];

    public function __construct(protected array $dependencies = [])
    {
    }

    public function set(string $class, object $instance): void
    {
        $this->objects[$class] = $instance;
    }

    public function get($id): object
    {
        if (array_key_exists($id, $this->objects)) {
            return $this->objects[$id];
        }

        if (!$this->has($id)) {
            throw new DependencyNotFoundException(sprintf('Dependency %s does not exist', $id));
        }

        $params = array_map([$this, 'get'], $this->dependencies[$id]);

        return $this->objects[$id] = new $id(...$params);
    }

    public function has($id): bool
    {
        return isset($this->dependencies[$id]) || array_key_exists($id, $this->dependencies);
    }
}