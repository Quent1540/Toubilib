<?php
use toubilib\infra\repositories\PDOPraticienRepository;
use toubilib\core\application\usecases\ServicePraticien;

return [
    'pdo' => function($container) {
        $settings = $container->get('settings')['db'];
        return new \PDO($settings['dsn'], $settings['user'], $settings['password']);
    },
    'praticienRepository' => function($container) {
        return new PDOPraticienRepository($container->get('pdo'));
    },
    'servicePraticien' => function($container) {
        return new ServicePraticien($container->get('praticienRepository'));
    },
];