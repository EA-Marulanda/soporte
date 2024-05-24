<?php
namespace App\Auth\Login\Infrastructure\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use App\Auth\Login\Domain\Repository\UserRepositoryInterface;
use App\Auth\Login\Domain\Model\Usuario;

class SymfonySecurityAdapter implements UserProviderInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByUsername($identifier);
        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof Usuario) {
            throw new UnsupportedUserException();
        }

        return $this->loadUserByIdentifier($user->getUsuario());
    }

    public function supportsClass(string $class): bool
    {
        return Usuario::class === $class;
    }
}
