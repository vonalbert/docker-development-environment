<?php

// -------------------------------------------------------------
// PgAdmin Configuration
// -------------------------------------------------------------

if (empty($config['pgadmin'])) {
    return;
}


$pgadmin = $config['pgadmin'];

$port = $pgadmin['port'] ?? 80;
$email = $pgadmin['email'] ?? null;
$password = $pgadmin['password'] ?? null;

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
