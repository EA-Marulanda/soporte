<?php

namespace App\Auth\Login\Application;

use App\Auth\Login\Domain\Repository\UserRepositoryInterface;
use App\Auth\Login\Domain\Service\UserAuthenticationServiceInterface;
use App\Auth\Login\Domain\Model\Usuario;

class AuthenticationService implements UserAuthenticationServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate(string $username, string $password): ?Usuario
    {
        $user = $this->userRepository->findByUsername($username);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }

}

