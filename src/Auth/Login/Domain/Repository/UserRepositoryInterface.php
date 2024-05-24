<?php

namespace App\Auth\Login\Domain\Repository;

use App\Auth\Login\Domain\Model\Usuario;

interface UserRepositoryInterface
{
    public function findByUsername(string $username): ?Usuario;
    public function findAll(): array;
    public function findById(int $id): ?Usuario;
    public function save(Usuario $user): void;
    public function delete(Usuario $user): void;
}
