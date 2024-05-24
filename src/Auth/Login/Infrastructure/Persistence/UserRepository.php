<?php

namespace App\Auth\Login\Infrastructure\Persistence;

use App\Auth\Login\Domain\Model\Usuario;
use App\Auth\Login\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
        $this->entityManager = $entityManager = $this->getEntityManager(); // Recommended approach
    }

    public function findByUsername(string $username): ?Usuario
    {
        return $this->findOneBy(['usuario' => $username]);
    }

    public function findById(int $id): ?Usuario
    {
        return $this->find($id);
    }

    public function save(Usuario $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function delete(Usuario $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return parent::findAll();
    }
}
