<?php
namespace toubilib\core\application\ports\spi;

use toubilib\core\domain\entities\Praticien;

Interface PraticienRepositoryInterface{
    public function findAll(): array;
}