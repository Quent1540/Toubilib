<?php
namespace toubilib\core\application\ports\api\dtos;

class InputRendezVousDTO
{
    public string $praticienId;
    public string $patientId;
    public \DateTimeImmutable $dateHeure;
    public string $motif;
    public int $dureeMinutes;

    public function __construct(
        string $praticienId,
        string $patientId,
        \DateTimeImmutable $dateHeure,
        string $motif,
        int $dureeMinutes
    ) {
        $this->praticienId = $praticienId;
        $this->patientId = $patientId;
        $this->dateHeure = $dateHeure;
        $this->motif = $motif;
        $this->dureeMinutes = $dureeMinutes;
    }
}