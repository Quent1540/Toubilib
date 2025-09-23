<?php

use toubilib\api\actions\creerRDVAction;
use toubilib\api\actions\getPraticienDetailsAction;
use toubilib\api\actions\getRDVAction;
use toubilib\core\application\ports\spi\PraticienRepositoryInterface;
use toubilib\core\application\ports\spi\RDVRepositoryInterface;
use toubilib\infra\repositories\PDOPraticienRepository;
use toubilib\api\actions\getAllPraticiensAction;
use toubilib\infra\repositories\PDORdvRepository;

return [
    'pdo' => function($container) {
        $settings = $container->get('settings')['db'];
        return new \PDO($settings['dsn'], $settings['user'], $settings['password']);
    },
    'pdo_rdv' => function($container) {
        $settings = $container->get('settings')['db_rdv'];
        return new \PDO($settings['dsn'], $settings['user'], $settings['password']);
    },
    PraticienRepositoryInterface::class => function($container) {
        return new PDOPraticienRepository($container->get('pdo'));
    },
    getAllPraticiensAction::class => function($container) {
        return new getAllPraticiensAction($container->get(PraticienRepositoryInterface::class));
    },
    \toubilib\api\actions\getCreneauxAction::class => function($container) {
        return new \toubilib\api\actions\getCreneauxAction($container->get(RDVRepositoryInterface::class));
    },
    RDVRepositoryInterface::class => function($container) {
        return new PDORdvRepository($container->get('pdo_rdv'));
    },
    getPraticienDetailsAction::class => function($container) {
        return new getPraticienDetailsAction($container->get(PraticienRepositoryInterface::class));
    },
    getRDVAction::class => function($container) {
        return new getRDVAction($container->get(RDVRepositoryInterface::class));
    },
    creerRDVAction::class => function($container) {
        return new creerRDVAction($container->get(RDVRepositoryInterface::class));
    },
];