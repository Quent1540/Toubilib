<?php

namespace src\api\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class getAllPraticiensAction extends AbstractAction
{
    private $servicePraticien;

    public function __construct($servicePraticien)
    {
        $this->servicePraticien = $servicePraticien;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $praticiens = $this->servicePraticien->listerPraticiens();

        $response->getBody()->write(json_encode($praticiens));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}