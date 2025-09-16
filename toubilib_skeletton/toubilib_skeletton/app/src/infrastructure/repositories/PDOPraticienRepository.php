<?php
namespace toubilib\infra\repositories;

use toubilib\core\application\ports\spi\PraticienRepositoryInterface;
use toubilib\core\domain\entities\praticien\Praticien;

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

    public function findById($id): Praticien
    {
        $stmt = $this->pdo->prepare('SELECT * FROM praticien WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) {
            throw new \RuntimeException("Praticien non trouvé avec l'id $id");
        }

        return new Praticien($row['id'], $row['nom'], $row['prenom'], $row['specialite_id']);
    }
}