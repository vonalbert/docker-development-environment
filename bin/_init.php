<?php

if (PHP_VERSION_ID < 70000) {
    die('PHP >= 7.0 is required.');
}

if (!function_exists('docker_compose')) {
    function docker_compose($args)
    {
        exec('docker-compose -f docker-compose.json ' . $args);
    }
}

if (!function_exists('docker_compose_generate')) {
    function docker_compose_generate()
    {
        $config = json_decode(file_get_contents(__DIR__ . '/../config.json'), true);

        $compose = [
            'version' => '3.7',
            'services' => [],
        ];


        include __DIR__ . '/../docker/phpmyadmin/load.php';
        include __DIR__ . '/../docker/pgadmin/load.php';
        include __DIR__ . '/../docker/mysql/load.php';
        include __DIR__ . '/../docker/postgres/load.php';

        // Generate docker compose file
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $content = json_encode($compose, JSON_UNESCAPED_SLASHES);

        if (file_put_contents($file, $content) === false) {
            throw new \RuntimeException(sprintf(
                'Cannot write content to %s file',
                $file
            ));
        }
    }
}
