<?php

// -------------------------------------------------------------
// PHPMyAdmin Services Configuration
// -------------------------------------------------------------

if (empty($config['phpmyadmin'])) {
    return;
}


$phpmyadmin = $config['phpmyadmin'];
$port = $phpmyadmin['port'] ?? 80;

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
