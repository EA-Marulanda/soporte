<?php

namespace App\Auth\Login\Infrastructure\Persistence;

use App\Auth\Login\Domain\Model\Rol;
use App\Auth\Login\Domain\Repository\RolRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RolRepository extends ServiceEntityRepository implements RolRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rol::class);
    }
  
    public function findAll(): array
    {
        return parent::findAll();
    }
}
