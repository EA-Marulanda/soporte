<?php

namespace App\Soporte\Dominio\Entidades;

use App\Auth\Login\Domain\Model\Usuario;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'usuario_soporte')]
class UsuarioSoporte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Usuario::class)]
    #[ORM\JoinColumn(name: 'id_usuario', referencedColumnName: 'id')]
    private ?Usuario $usuario;

    #[ORM\ManyToOne(targetEntity: Soporte::class)]
    #[ORM\JoinColumn(name: 'id_soporte', referencedColumnName: 'id')]
    private ?Soporte $soporte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getSoporte(): ?Soporte
    {
        return $this->soporte;
    }

    public function setSoporte(?Soporte $soporte): self
    {
        $this->soporte = $soporte;

        return $this;
    }
}
