<?php
namespace toubilib\api\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class getPraticienDetailsAction extends AbstractAction
{
    private $servicePraticien;

    public function __construct($servicePraticien)
    {
        $this->servicePraticien = $servicePraticien;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'];
        $praticien = $this->servicePraticien->afficherPraticien($id);

        if ($praticien) {
            $response->getBody()->write(json_encode($praticien));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } else {
            $response->getBody()->write(json_encode(['error' => 'Praticien not found']));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
    }
}