<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Config;

use function array_merge;
use function glob;
use function is_file;

class ConfigLoader
{
    public function __construct(
        protected string $configSource,
    )
    {
        $this->configSource = rtrim($configSource, '/');
    }

    public function getAllRoutesFromConfig(): array
    {
        return is_file($this->configSource) ? $this->getConfigFromFile() : $this->getConfigFromDirectory();
    }

    protected function getConfigFromFile(): array
    {
        return require_once $this->configSource;
    }

    protected function getConfigFromDirectory(): array
    {
        $config = [];
        foreach (glob($this->configSource.'/*.php') as $configFile)
        {
            $config = array_merge($config, require_once $configFile);
        }
        return $config;
    }
}