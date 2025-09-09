<?php
namespace toubilib\core\application\ports\api\spi;

use toubilib\core\domain\entities\Praticien;

Interface PraticienRepositoryInterface{
    public function findAll(): array;
}