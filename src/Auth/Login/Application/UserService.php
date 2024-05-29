<?php

namespace App\Auth\Login\Application;

use App\Auth\Login\Domain\Model\Rol;
use App\Auth\Login\Domain\Model\Usuario;
use App\Auth\Login\Domain\Service\PasswordHasherInterface;
use App\Auth\Login\Infrastructure\Persistence\RolRepository;
use App\Auth\Login\Infrastructure\Persistence\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    private PasswordHasherInterface $passwordHasher;
    private $rolRepository;

    public function __construct(UserRepository $userRepository, PasswordHasherInterface $passwordHasher, RolRepository $rolRepository)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->rolRepository = $rolRepository;
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

    public function createUser(string $nombre,string $usuario, string $contrasena, bool $tiene_captcha,bool $estado,Rol $rol): void
    {
        $hashedContasena = $this->passwordHasher->hashPassword($contrasena);

        $user = new Usuario($nombre, $usuario, $hashedContasena,$tiene_captcha, $estado,$rol);
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
    
    public function getAllRoles(): array
    {
        return $this->rolRepository->findAll();
    }

}