<?php

namespace App\Auth\Login\Domain\Repository;

use App\Auth\Login\Domain\Model\Usuario;

interface RolRepositoryInterface
{
    public function findAll(): array;
}
