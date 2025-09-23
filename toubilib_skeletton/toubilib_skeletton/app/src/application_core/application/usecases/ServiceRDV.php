<?php

namespace toubilib\core\application\usecases;

use toubilib\core\application\ports\api\dtos\InputRendezVousDTO;
use toubilib\core\application\ports\api\ServiceRDVInterface;
use toubilib\core\application\ports\spi\RDVRepositoryInterface;
use toubilib\core\domain\entities\RDV;

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

    public function creerRendezVous(InputRendezVousDTO $dto): void
    {
        $rdv = new RDV(
            $dto->praticienId,
            $dto->patientId,
            $dto->dateHeure,
            $dto->motif,
            $dto->dureeMinutes,
        );
        $this->rdvRepository->creerRendezVous($rdv);
    }
}