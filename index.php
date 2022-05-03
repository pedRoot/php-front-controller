<?php

error_reporting(E_ALL);

ini_set('ignore_repeated_errors', true);
ini_set('display_errors', false);
ini_set('log_errors', true);
ini_set('error_log', __DIR__ . '/logs/php_error.log');

require __DIR__ . '/vendor/autoload.php';

$dotenv =  Dotenv\Dotenv::createImmutable(__DIR__ . '/src/config/');
$dotenv->load();

require __DIR__ . '/src/lib/routes.php';
