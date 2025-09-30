<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use toubilib\api\actions\getAllPraticiensAction;


return function( \Slim\App $app):\Slim\App {



    $app->get('/', HomeAction::class);
    $app->get('/praticiens', \toubilib\api\actions\getAllPraticiensAction::class);
    $app->get('/praticiens/{id}/creneaux', \toubilib\api\actions\getCreneauxAction::class);
    $app->get('/praticiens/{id}', \toubilib\api\actions\getPraticienDetailsAction::class);
    $app->get('/rdvs/{id}', \toubilib\api\actions\getRDVAction::class);
    $app->post('/rdvs', \toubilib\api\actions\creerRDVAction::class);

    return $app;
};