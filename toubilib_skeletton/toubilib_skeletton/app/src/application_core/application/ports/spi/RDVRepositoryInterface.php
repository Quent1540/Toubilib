<?php
namespace toubilib\core\application\ports\spi;

use toubilib\core\domain\entities\praticien\Praticien;
use toubilib\core\domain\entities\rdv\RDV;

Interface RDVRepositoryInterface{
    public function listerCreneaux($praticienId, $dateDebut, $dateFin): array;
    public function getRDVById($id): ?RDV;
}