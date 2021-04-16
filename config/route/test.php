<?php
return [
    'show_login' => [
        'path' => '/login',
        'controller' => User::class,
        'action' => 'showLogin',
        'method' => 'GET'
    ],
    'check_login' => [
        'path' => '/login',
        'controller' => User::class,
        'action' => 'checkLogin',
        'method' => 'POST'
    ],
    'logout' => [
        'path' => '/logout',
        'controller' => User::class,
        'action' => 'logout',
        'method' => 'GET'
    ],
    'account' => [
        'path' => '/account',
        'controller' => User::class,
        'action' => 'show',
        'method' => 'GET'
    ],
    'transaction_payments_rearrangement' => [
        'path' => '/transaction/payment/rearrangement',
        'controller' => Transaction::class,
        'action' => 'newRearrangement',
        'method' => 'GET'
    ],
    'transaction_payments' => [
        'path' => '/transaction/payment/(\w+)/(\d+)',
        'controller' => Transaction::class,
        'action' => 'newPayment',
        'method' => 'GET',
        'params' => ['paymentType', 'paymentCount']
    ]
];
