<?php

namespace toubilib\api\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use toubilib\core\application\ports\spi\PraticienRepositoryInterface;

class getAllPraticiensAction extends AbstractAction
{
    private $servicePraticien;

    public function __construct(PraticienRepositoryInterface $servicePraticien)
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