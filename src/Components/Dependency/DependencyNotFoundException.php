<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Dependency;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class DependencyNotFoundException extends Exception implements NotFoundExceptionInterface
{

}