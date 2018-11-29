<?php

// -------------------------------------------------------------
// PostgreSQL Services Configuration
// -------------------------------------------------------------

if (empty($config['postgres'])) {
    return;
}


foreach ($config['postgres'] as $postgres) {
    $version = $postgres['version'];
    $port = $postgres['port'];
    $host = sprintf('pgsql_%s', str_replace('.', '', $version));

    $compose['services'][$host] = [
        'build' => [
            'context' => 'docker/postgres',
            'args' => ['VERSION' => $version],
        ],
        'volumes' => [
            sprintf('./var/pgsql/%s:/var/lib/postgresql/data', $version),
        ],
        'ports' => [
            sprintf('%d:5432', $port),
        ],
    ];

    $compose['services']['pgadmin']['links'][] = $host;
}
