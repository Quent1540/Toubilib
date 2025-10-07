<?php
namespace toubilib\core\application\usecases;

use toubilib\core\application\ports\api\dtos\ProfilDTO;
use toubilib\core\domain\entities\user\User;

interface AuthnServiceInterface {
    public function verifyCredentials(string $email, string $password): ProfilDTO;
}