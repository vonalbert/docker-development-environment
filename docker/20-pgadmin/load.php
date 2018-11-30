<?php

// -------------------------------------------------------------
// PgAdmin Configuration
// -------------------------------------------------------------

$config = require __DIR__ . '/_config.php';

$port = $config['port'] ?? 80;
$email = $config['email'] ?? null;
$password = $config['password'] ?? null;

$compose['services']['pgadmin'] = [
    'image' => 'dpage/pgadmin4',
    'volumes' => [
        './var/pgadmin:/var/lib/pgadmin'
    ],
    'ports' => [
        sprintf('%d:80', $port)
    ],
    'environment' => [
        'PGADMIN_DEFAULT_EMAIL' => $email,
        'PGADMIN_DEFAULT_PASSWORD' => $password,
    ],
];
