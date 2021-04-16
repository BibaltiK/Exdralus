<?php
return [
    'show_login' => [
        'path' => '/login',
        'controller' => User::class,
        'method' => 'GET'
    ],
    'check_login' => [
        'path' => '/login',
        'controller' => User::class,
        'method' => 'POST'
    ],
    'logout' => [
        'path' => '/logout',
        'controller' => User::class,
        'method' => 'GET'
    ],
    'account' => [
        'path' => '/account',
        'controller' => User::class,
        'method' => 'GET'
    ],
    'transaction_payments_rearrangement' => [
        'path' => '/transaction/payment/rearrangement',
        'controller' => Transaction::class,
        'method' => 'GET'
    ],
    'transaction_payments' => [
        'path' => '/transaction/payment/(\w+)/(\d+)',
        'controller' => Transaction::class,
        'method' => 'GET',
        'params' => ['paymentType', 'paymentCount']
    ]
];
