<?php

namespace App\Soporte\Infraestructura\Persistencia;

use App\Auth\Login\Domain\Model\Usuario;
use App\Soporte\Dominio\Entidades\Soporte;
use App\Soporte\Dominio\Entidades\UsuarioSoporte;
use App\Soporte\Dominio\Repositorio\UsuarioSoporteRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioSoporteRepository extends ServiceEntityRepository implements UsuarioSoporteRepositoryInterface
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioSoporte::class);
        $this->entityManager = $entityManager = $this->getEntityManager(); // Recommended approach
    }

    public function registrarUsuarioSoporte(UsuarioSoporte $soporte): void
    {
        $this->entityManager->persist($soporte);
        $this->entityManager->flush();
    }

    public function usuarioMasCarga(): ?Usuario
    {
        $query = $this->entityManager->createQuery(
            'SELECT u, COALESCE(SUM(s.prioridad), 0) AS suma_prioridades
            FROM App\Auth\Login\Domain\Model\Usuario u
            LEFT JOIN App\Soporte\Dominio\Entidades\UsuarioSoporte us WITH u.id = us.usuario
            LEFT JOIN App\Soporte\Dominio\Entidades\Soporte s WITH s.id = us.soporte
            WHERE u.rol= 2
            GROUP BY u.id
            ORDER BY suma_prioridades ASC'
        );
        
        // Obtener el resultado de la consulta
        $usuarios = $query->getResult();
        // Obtener el resultado de la co
    
        // Si hay usuarios, devolver el primero (con la menor carga) o cualquier usuario si no hay ninguno
        if (!empty($usuarios)) {
            return $usuarios[0][0];
        }
    
        return null;
    }
        

   
}
