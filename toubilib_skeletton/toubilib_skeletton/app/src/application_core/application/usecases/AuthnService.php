<?php
namespace toubilib\core\application\usecases;

use toubilib\core\application\ports\api\dtos\ProfilDTO;
use toubilib\core\domain\entities\user\User;

//Service d'authentification pour la gestion des utilisateurs
class AuthnService implements AuthnServiceInterface {
    //Vérif des identifiants de l'utilisateur
    public function verifyCredentials(string $email, string $password): ProfilDTO {
        //Recherche l'utilisateur par email
        $user = User::query()->where('email', $email)->first();

        //Vérif le mdr fourni avec le hash en base
        if ($user && password_verify($password, $user->password)) {
            return new ProfilDTO($user);
        }
        throw new \Exception("Identifiants invalides");
    }
}