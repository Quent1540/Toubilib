<?php
namespace toubilib\core\application\ports\spi;

use toubilib\core\domain\entities\praticien\Praticien;

Interface PraticienRepositoryInterface{
    public function findAll(): array;
    public function findById($id): Praticien;
}