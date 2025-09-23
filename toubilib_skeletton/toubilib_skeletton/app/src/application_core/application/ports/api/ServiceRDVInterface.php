<?php
namespace toubilib\core\application\ports\api;

use toubilib\core\application\ports\api\dtos\InputRendezVousDTO;

Interface ServiceRDVInterface{
    public function listerCreneaux($praticienId, $dateDebut, $dateFin): array;
    public function creerRendezVous(InputRendezVousDTO $dto): void;
}