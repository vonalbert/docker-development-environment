<?php

// -------------------------------------------------------------
// PHPMyAdmin Services Configuration
// -------------------------------------------------------------

$config = require __DIR__ . '/_config.php';

$port = $config['port'] ?? 80;

$compose['services']['phpmyadmin'] = [
    'image' => 'phpmyadmin/phpmyadmin',
    'ports' => [
        sprintf('%d:80', $port)
    ],
    'environment' => [
        'PMA_ARBITRARY' => '1',
        'PMA_USER' => 'root',
        'PMA_PASSWORD' => 'password',
    ]
];
