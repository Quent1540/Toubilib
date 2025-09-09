<?php

namespace toubilib\core\application\usecases;

use toubilib\core\application\ports\api\ServicePraticienInterface;
use toubilib\core\application\ports\spi\PraticienRepositoryInterface;

class ServicePraticien implements ServicePraticienInterface
{
    private PraticienRepositoryInterface $praticienRepository;

    public function __construct(PraticienRepositoryInterface $praticienRepository)
    {
        $this->praticienRepository = $praticienRepository;
    }

    public function listerPraticiens(): array {
    	return $this->praticienRepository->findAll();
    }

    public function afficherPraticien($id) {
        return $this->praticienRepository->findById($id);
    }
}