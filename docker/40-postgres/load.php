<?php

// -------------------------------------------------------------
// PostgreSQL Services Configuration
// -------------------------------------------------------------

$config = require __DIR__ . '/_config.php';

$hosts = [];

foreach ($config as $instance) {
    $version = $instance['version'];
    $port = $instance['port'];

    $hosts[] = $host = sprintf('pgsql_%s', str_replace('.', '', $version));

    $compose['services'][$host] = [
        'build' => [
            'context' => __DIR__,
            'args' => ['VERSION' => $version],
        ],
        'volumes' => [
            sprintf('./var/pgsql/%s:/var/lib/postgresql/data', $version),
        ],
        'ports' => [
            sprintf('%d:5432', $port),
        ],
    ];
}

$compose['services']['pgadmin']['links'][] = $host;
