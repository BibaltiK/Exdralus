<?php

use Exdrals\Exdralus\App\Index;

return [
    'index' => [
        'path' => '/',
        'controller' => Index::class,
        'action' => 'index',
        'method' => 'GET'
    ]
];