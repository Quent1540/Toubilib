<?php
namespace toubilib\core\application\ports\api\dtos;

use toubilib\core\domain\entities\user\User;

class ProfilDTO{
    private int $id;
    private string $email;
    private string $role;

    public function __construct(User $user) {
        $this->id = $user->id;
        $this->email = $user->email;
        $this->role = $user->role;
    }
}