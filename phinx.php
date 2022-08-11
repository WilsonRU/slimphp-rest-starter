<?php

use Doctrine\ORM\EntityManager;

require __DIR__ . '/bootstrap.php';

/** @var EntityManager $em */
$em = $app->getContainer()->get('doctrine');
$connection = $em->getConnection()->getWrappedConnection();

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations'
    ],
    'environments' => [
        'default_database' => 'development',
        'development' => [
            'name' => 'database',
            'connection' => $connection,
        ]
    ],
];