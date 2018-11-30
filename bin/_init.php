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
        exec(__DIR__ . '/generate');
    }
}
