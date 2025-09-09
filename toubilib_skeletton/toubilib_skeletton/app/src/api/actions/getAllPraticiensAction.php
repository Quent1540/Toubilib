<?php

namespace src\api\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class getAllPraticiensAction extends AbstractAction
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $servicePraticien = $this->container->get('servicePraticien');
        $praticiens = $servicePraticien->listerPraticiens();

        $response->getBody()->write(json_encode($praticiens));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}