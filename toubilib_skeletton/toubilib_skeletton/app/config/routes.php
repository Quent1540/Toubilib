<?php
declare(strict_types=1);

use toubilib\api\actions\getPraticienDetailsAction;
use toubilib\api\actions\getAllPraticiensAction;

return function(\Slim\App $app): \Slim\App {
    $app->get('/praticiens', 'getAllPraticiensAction');
    $app->get('/praticiens/1', 'getPraticienDetailsAction');
    return $app;
};