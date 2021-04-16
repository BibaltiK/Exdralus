<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Http;


final class Server extends DataCollection
{

    public function __construct(array $serverData)
    {
        parent::__construct($serverData);
    }

    public function getRequestURI(): string
    {
        return $this->get('REQUEST_URI');
    }

    public function getRequestMethod(): string
    {
        return $this->get('REQUEST_METHOD');
    }
}