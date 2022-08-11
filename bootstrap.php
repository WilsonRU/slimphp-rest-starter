<?php

require_once __DIR__ . '/vendor/autoload.php';

use \Slim\App;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = require __DIR__ . '/config/container.php';
$app = new App($container);

require_once __DIR__ . '/config/routes.php';