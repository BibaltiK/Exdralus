<?php

declare(strict_types=1);

namespace Exdrals\Exdralus\Components\Http;

class Request
{
    protected Server $server;

    public function __construct(array $server)
    {
        $this->server = new Server($server);
    }

    public function getServer(): Server
    {
        return $this->server;
    }
}