<?php
namespace toubilib\infra\repositories;

use toubilib\core\application\ports\spi\PraticienRepositoryInterface;

class PDOPraticienRepository implements PraticienRepositoryInterface
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare('SELECT * FROM praticien');
        $stmt->execute();

        $praticiens = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $praticiens[] = new \toubilib\core\domain\entities\praticien\Praticien($row['id'], $row['nom'], $row['prenom'], $row['specialite_id']);
        }
        return $praticiens;
    }
}