<?php

use App\Application\Middleware;
use App\Application\Rest\LoginAction;
use Slim\Container;

/** @var Container $container */
$container = $app->getContainer();

$app->add(new Middleware\ErrorHandler());

$app->post('/login', new LoginAction($container));
