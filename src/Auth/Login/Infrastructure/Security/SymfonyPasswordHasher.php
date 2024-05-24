<?php
// src/Auth/Login/Infrastructure/Security/SymfonyPasswordHasher.php
namespace App\Auth\Login\Infrastructure\Security;

use App\Auth\Login\Domain\Service\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Auth\Login\Domain\Model\Usuario;

class SymfonyPasswordHasher implements PasswordHasherInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function hashPassword(string $plainPassword): string
    {
        // Usando SHA-512 directamente
        return hash('sha512', $plainPassword);

        // O usando el PasswordHasher de Symfony
        // return $this->passwordHasher->hashPassword(new Usuario(), $plainPassword);
    }
}
