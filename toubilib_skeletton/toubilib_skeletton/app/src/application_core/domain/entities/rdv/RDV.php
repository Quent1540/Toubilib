<?php

namespace toubilib\core\domain\entities\rdv;

class RDV
{
    private string $id_prat;
    private string $id_pat;
    private string $date_heure_debut;
    private string $date_heure_fin;
    private string $motif;
    private int $duree;

    public function __construct(string $id_prat,string $id_pat, string $date_heure_debut,string $date_heure_fin, string $motif, int $duree){
        $this->id_prat = $id_prat;
        $this->id_pat = $id_pat;
        $this->date_heure_debut = $date_heure_debut;
        $this->date_heure_fin = $date_heure_fin;
        $this->motif = $motif;
        $this->duree = $duree;
    }

    public function toArray(): array{
        return [
            'id_prat' => $this->id_prat,
            'id_pat' => $this->id_pat,
            'date_heure_debut' => $this->date_heure_debut,
            'date_heure_fin' => $this->date_heure_fin,
            'motif' => $this->motif,
            'duree' => $this->duree
        ];
    }

    public function getIdPrat(): string{
        return $this->id_prat;
    }
    public function getIdPat(): string{
        return $this->id_pat;
    }
    public function getDateHeureDebut(): string{
        return $this->date_heure_debut;
    }
    public function getDateHeureFin(): string{
        return $this->date_heure_fin;
    }
    public function getMotif(): string{
        return $this->motif;
    }
    public function getDuree(): int
    {
        return $this->duree;
    }
}