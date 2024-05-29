<?php

namespace App\Soporte\Infraestructura\Persistencia;


use App\Soporte\Dominio\Entidades\Soporte;
use App\Soporte\Dominio\Repositorio\SoporteRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SoporteRepository extends ServiceEntityRepository implements SoporteRepositoryInterface
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soporte::class);
        $this->entityManager = $entityManager = $this->getEntityManager(); // Recommended approach
    }

    public function registrarSoporte(Soporte $soporte): void
    {
        $this->entityManager->persist($soporte);
        $this->entityManager->flush();
    }
    

   
}
