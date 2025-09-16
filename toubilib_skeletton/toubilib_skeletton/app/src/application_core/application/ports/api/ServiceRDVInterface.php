<?php
namespace toubilib\core\application\ports\api;

Interface ServiceRDVInterface{
    public function listerCreneaux($praticienId, $dateDebut, $dateFin): array;
}