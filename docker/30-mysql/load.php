<?php

// -------------------------------------------------------------
// MySQL Services Configuration
// -------------------------------------------------------------

$config = require __DIR__ . '/_config.php';

$hosts = [];

foreach ($config as $instance) {
    $version = $instance['version'];
    $port = $instance['port'];

    $hosts[] = $host = sprintf('mysql_%s', str_replace('.', '', $version));

    $compose['services'][$host] = [
        'build' => [
            'context' => __DIR__,
            'args' => ['VERSION' => $version],
        ],
        'volumes' => [
            sprintf('./var/mysql/%s:/var/lib/mysql', $version),
        ],
        'ports' => [
            sprintf('%d:3306', $port),
        ],
    ];
}

$compose['services']['phpmyadmin']['links'] = $hosts;
$compose['services']['phpmyadmin']['environment']['PMA_HOSTS'] = implode(',', $hosts);
