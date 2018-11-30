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
        $compose = [
            'version' => '3.7',
            'services' => [],
        ];


        foreach (glob(__DIR__ . '/../docker/*/load.php') as $loadFile) {
            require $loadFile;
        }


        // Generate docker compose file
        $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'docker-compose.json';
        $content = json_encode($compose, JSON_UNESCAPED_SLASHES);

        if (file_put_contents($file, $content) === false) {
            throw new \RuntimeException(sprintf(
                'Cannot write content to %s file',
                $file
            ));
        }
    }
}
