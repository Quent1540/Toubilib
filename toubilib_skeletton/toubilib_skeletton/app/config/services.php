<?php

use toubilib\api\actions\getPraticienDetailsAction;
use toubilib\core\application\ports\spi\PraticienRepositoryInterface;
use toubilib\infra\repositories\PDOPraticienRepository;
use toubilib\api\actions\getAllPraticiensAction;

return [
    'pdo' => function($container) {
        $settings = $container->get('settings')['db'];
        return new \PDO($settings['dsn'], $settings['user'], $settings['password']);
    },
    PraticienRepositoryInterface::class => function($container) {
        return new PDOPraticienRepository($container->get('pdo'));
    },
    getAllPraticiensAction::class => function($container) {
        return new getAllPraticiensAction($container->get(PraticienRepositoryInterface::class));
    },
    getPraticienDetailsAction::class => function($container) {
        return new getPraticienDetailsAction($container->get(PraticienRepositoryInterface::class));
    },
];