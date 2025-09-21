<?php
namespace toubilib\infra\repositories;

use toubilib\core\application\ports\spi\PraticienRepositoryInterface;
use toubilib\core\domain\entities\praticien\Praticien;
use toubilib\core\domain\entities\praticien\Specialite;

class PDOPraticienRepository implements PraticienRepositoryInterface{
    private \PDO $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function listerPraticiens(): array{
        $stmt = $this->pdo->prepare('SELECT p.*, s.id as specialite_id, s.libelle as specialite_libelle, s.description as specialite_description FROM praticien p JOIN specialite s ON p.specialite_id = s.id');
        $stmt->execute();

        $praticiens = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $specialite = new Specialite(
                (int)$row['specialite_id'],
                $row['specialite_libelle'],
                $row['specialite_description']
            );
            $praticiens[] = new Praticien(
                $row['id'],
                $row['nom'],
                $row['prenom'],
                $specialite
            );
        }
        return $praticiens;
    }

    public function detailsPraticien(string $id): ?Praticien{
        $stmt = $this->pdo->prepare('SELECT p.*, s.id as specialite_id, s.libelle as specialite_libelle, s.description as specialite_description FROM praticien p JOIN specialite s ON p.specialite_id = s.id WHERE p.id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) return null;

        //Specialité
        $specialite = new Specialite(
            (int)$row['specialite_id'],
            $row['specialite_libelle'],
            $row['specialite_description']
        );

        //Motif de visite
        $stmtMotifs = $this->pdo->prepare('SELECT m.id, m.libelle FROM praticien2motif pm JOIN motif_visite m ON pm.motif_id = m.id WHERE pm.praticien_id = :id');
        $stmtMotifs->execute(['id' => $id]);
        $motifs = [];
        while ($motif = $stmtMotifs->fetch(\PDO::FETCH_ASSOC)){
            $motifs[] = new \toubilib\core\domain\entities\praticien\MotifVisite($motif['id'], $motif['libelle']);
        }

        //Moyens de paiement
        $stmtMoyens = $this->pdo->prepare('SELECT mp.id, mp.libelle FROM praticien2moyen pm JOIN moyen_paiement mp ON pm.moyen_id = mp.id WHERE pm.praticien_id = :id');
        $stmtMoyens->execute(['id' => $id]);
        $moyens = [];
        while ($moyen = $stmtMoyens->fetch(\PDO::FETCH_ASSOC)){
            $moyens[] = new \toubilib\core\domain\entities\praticien\MoyenPaiement($moyen['id'], $moyen['libelle']);
        }

        //Affichage du praticien
        return new Praticien(
            $row['id'],
            $row['nom'],
            $row['prenom'],
            $specialite,
            $motifs,
            $moyens
        );
    }
}