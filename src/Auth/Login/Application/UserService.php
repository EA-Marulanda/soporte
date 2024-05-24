<?php

namespace App\Auth\Login\Application;

use App\Auth\Login\Domain\Model\Usuario;
use App\Auth\Login\Domain\Service\PasswordHasherInterface;
use App\Auth\Login\Infrastructure\Persistence\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    private PasswordHasherInterface $passwordHasher;

    public function __construct(UserRepository $userRepository, PasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function getUserByUsername(string $username): ?Usuario
    {
        return $this->userRepository->findByUsername($username);
    }
    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function getUserById(int $id): ?Usuario
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(string $nombre,string $usuario, string $contrasena, bool $tiene_captcha,bool $estado,array $roles): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($contrasena);

        $user = new Usuario($nombre, $usuario, $hashedPassword,$tiene_captcha, $estado,$roles);
        $this->userRepository->save($user);
    }

    public function updateUser(Usuario $user, string $username, string $password, array $roles): void
    {
        $user->setUsuario($username);
        $user->setPassword($password);
        $user->setRoles($roles);
        $this->userRepository->save($user);
    }

    public function updateEstado(Usuario $user): void
    {
        $this->userRepository->save($user);
    }

    public function deleteUser(Usuario $user): void
    {
        $this->userRepository->delete($user);
    }

}