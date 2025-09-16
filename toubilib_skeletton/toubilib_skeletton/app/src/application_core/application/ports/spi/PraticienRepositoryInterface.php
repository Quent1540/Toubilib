<?php
namespace toubilib\core\application\ports\spi;

use toubilib\core\domain\entities\praticien\Praticien;

Interface PraticienRepositoryInterface{
    public function listerPraticiens(): array;
    public function detailsPraticien(string $id): ?Praticien;
}