<?php

namespace App\Soporte\Infraestructura\Persistencia;


use App\Soporte\Dominio\Entidades\UsuarioExterno;
use App\Soporte\Dominio\Repositorio\UsuarioExternoRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioExternoRepository extends ServiceEntityRepository implements UsuarioExternoRepositoryInterface
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioExterno::class);
        $this->entityManager = $entityManager = $this->getEntityManager(); // Recommended approach
    }

    public function registrar(UsuarioExterno $usuarioExterno): void
    {
        $this->entityManager->persist($usuarioExterno);
        $this->entityManager->flush();
    }
    

   
}
