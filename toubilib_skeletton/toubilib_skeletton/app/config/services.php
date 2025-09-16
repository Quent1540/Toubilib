<?php

use toubilib\core\application\ports\spi\PraticienRepositoryInterface;
use toubilib\infra\repositories\PDOPraticienRepository;
use toubilib\core\application\usecases\ServicePraticien;

return [
    'pdo' => function($container) {
        $settings = $container->get('settings')['db'];
        return new \PDO($settings['dsn'], $settings['user'], $settings['password']);
    },
    PraticienRepositoryInterface::class => function($container) {
        return new PDOPraticienRepository($container->get('pdo'));
    },
];