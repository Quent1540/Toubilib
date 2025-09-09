<?php

namespace toubilib\core\domain\entities\praticien;

class Praticien
{
    private string $id;
    private string $nom;
    private string $prenom;
    private string $specialite_id;

    public function __construct(string $id, string $nom, string $prenom, string $specialite_id){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->specialite_id = $specialite_id;
    }

    public function getPratId(): string{
        return $this->id;
    }

    public function getPratNom(): string{
        return $this->nom;
    }

    public function getPratPrenom(): string{
        return $this->prenom;
    }

    public function getPratSpecialiteId(): string{
        return $this->specialite_id;
    }
}