<?php

namespace toubilib\core\domain\entities;

class RDV
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

    public function toArray(): array{
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'specialite_id' => $this->specialite_id,
        ];
    }
}