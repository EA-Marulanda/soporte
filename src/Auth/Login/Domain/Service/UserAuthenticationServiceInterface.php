<?php

namespace App\Auth\Login\Domain\Service;

use App\Auth\Login\Domain\Model\Usuario;

interface UserAuthenticationServiceInterface
{
    public function authenticate(string $username, string $password): ?Usuario;
}