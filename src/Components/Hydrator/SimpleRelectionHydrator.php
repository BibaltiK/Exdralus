<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Hydrator;

use ReflectionClass;

class SimpleRelectionHydrator
{
    public function hydrate(array $data, object $object): object
    {
        $reflectionProperties = $this->getReflectionProperties($object);
        foreach ($data as $key => $value)
        {
            $reflectionProperties[$key]->setValue($object, $value);
        }
        return $object;
    }

    protected function getReflectionProperties(object $object): array
    {
        $reflectionClass = new ReflectionClass(get_class($object));
        $reflectionProperties = $reflectionClass->getProperties();
        $responseReflectionProperties = [];
        foreach ($reflectionProperties as $property)
        {
            $property->setAccessible(true);
            $responseReflectionProperties[$property->getName()] = $property;
        }
        return $responseReflectionProperties;
    }
}