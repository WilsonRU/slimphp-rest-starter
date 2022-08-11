<?php

use App\Domain\Repository\UsuarioRepositoryInterface;
use App\Infrastructure\Doctrine\DoctrineUsuarioRepository;
use Slim\Container;

/** @var Container */
$container = new Container();

require_once __DIR__ . '/../db/database.php';

// Service

// Repository
$container[UsuarioRepositoryInterface::class] = static function (Container $container) {
    return new DoctrineUsuarioRepository($container->get('doctrine'));
};

return $container;
