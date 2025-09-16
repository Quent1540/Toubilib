<?php

namespace toubilib\core\application\usecases;

use toubilib\core\application\ports\api\ServiceRDVInterface;
use toubilib\core\application\ports\spi\RDVRepositoryInterface;

class ServiceRDV implements ServiceRDVInterface
{
    private RDVRepositoryInterface $rdvRepository;

    public function __construct(RDVRepositoryInterface $rdvRepository)
    {
        $this->rdvRepository = $rdvRepository;
    }

    public function listerCreneaux($praticienId, $dateDebut, $dateFin): array
    {
        return $this->rdvRepository->listerCreneaux($praticienId, $dateDebut, $dateFin);
    }
}