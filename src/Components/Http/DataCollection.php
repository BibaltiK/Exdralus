<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Http;

use InvalidArgumentException;

use function array_key_exists;
use function sprintf;

class DataCollection
{
    protected array $dataCollection = [];

    public function __construct(array $dataCollection)
    {
        $this->dataCollection = $dataCollection;
    }

    protected function get(string $key): string
    {
        if (!$this->has($key)) {
            throw new InvalidArgumentException(sprintf('%s not found in global Server Array.', $key));
        }

        return $this->dataCollection[$key];
    }

    protected function has(string $key): bool
    {
        return (isset($this->dataCollection[$key]) || array_key_exists($this->dataCollection, $key));
    }
}