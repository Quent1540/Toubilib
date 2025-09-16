<?php
namespace toubilib\core\application\ports\spi;

use toubilib\core\domain\entities\praticien\Praticien;

Interface RDVRepositoryInterface{
    public function listerCreneaux($praticienId, $dateDebut, $dateFin): array;
}