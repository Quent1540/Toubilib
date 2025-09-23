<?php
namespace toubilib\infra\repositories;

use toubilib\core\application\ports\spi\PraticienRepositoryInterface;
use toubilib\core\domain\entities\praticien\Praticien;
use toubilib\core\application\ports\spi\RDVRepositoryInterface;
use toubilib\core\domain\entities\rdv\RDV;

class PDORdvRepository implements RDVRepositoryInterface
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listerCreneaux($praticienId, $dateDebut, $dateFin): array
    {
        $sql = "SELECT date_heure_debut, date_heure_fin 
            FROM rdv
            WHERE praticien_id = :praticienId
              AND date_heure_debut >= :dateDebut
              AND date_heure_fin <= :dateFin";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'praticienId' => $praticienId,
            'dateDebut' => $dateDebut,
            'dateFin' => $dateFin,
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function creerRendezVous(RDV $rdv): void
    {
        $sql = "INSERT INTO rdv (praticien_id, patient_id, date_heure, motif, duree_minutes)
                VALUES ($rdv->getIdPrat(), $rdv->getIdPat(), $rdv->getDateHeureDebut(),$rdv->getDateHeureFin, $rdv->getMotif(), $rdv->getDuree())";
    }

    public function getRDVById($id): ?RDV{
        $stmt = $this->pdo->prepare('SELECT * FROM rdv WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row) return null;

        return new \toubilib\core\domain\entities\rdv\RDV(
            $row['id'],
            $row['praticien_id'],
            $row['patient_id'],
            $row['date_heure_debut'],
            $row['date_heure_fin'],
            $row['duree'],
        );
    }
}