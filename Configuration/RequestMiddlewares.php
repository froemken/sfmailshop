<?php
return [
    'frontend' => [
        'stefanfroemken/sfmailshop-add-to-cart' => [
            'target' => \StefanFroemken\Sfmailshop\Middleware\AddToCartMiddleware::class,
            'after' => [
                'typo3/cms-frontend/authentication',
            ]
        ],
    ]
];
