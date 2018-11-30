<?php

// -------------------------------------------------------------
// MySQL Services Configuration
// -------------------------------------------------------------

if (empty($config['mysql'])) {
    return;
}


$pma_hosts = [];

foreach ($config['mysql'] as $mysql) {
    $version = $mysql['version'];
    $port = $mysql['port'];
    $host = sprintf('mysql_%s', str_replace('.', '', $version));

    $compose['services'][$host] = [
        'build' => [
            'context' => 'docker/mysql',
            'args' => ['VERSION' => $version],
        ],
        'volumes' => [
            sprintf('./var/mysql/%s:/var/lib/mysql', $version),
        ],
        'ports' => [
            sprintf('%d:3306', $port),
        ],
    ];

    $compose['services']['phpmyadmin']['links'][] = $host;
    $pma_hosts[] = $host;
}

$compose['services']['phpmyadmin']['environment']['PMA_HOSTS'] = implode(',', $pma_hosts);
