<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use src\api\actions\getAllPraticiensAction;


return function( \Slim\App $app):\Slim\App {



    $app->get('/', HomeAction::class);
    $app->get('/praticiens', getAllPraticiensAction::class);
    $app->get('/praticiens/1', \toubilib\api\actions\getPraticienDetailsAction::class);

    return $app;
};