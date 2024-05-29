<?php

namespace App\Soporte\Dominio\Entidades;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

#[ORM\Entity]
#[ORM\Table(name: 'soporte')]
class Soporte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $asunto;

    #[ORM\Column(type: 'text')]
    private string $descripcion;

    #[ORM\Column(type: 'datetime')]
    private DateTime $fecha;

    #[ORM\Column(type: 'integer')]
    private int $prioridad;

    #[ORM\ManyToOne(targetEntity: UsuarioExterno::class)]
    #[ORM\JoinColumn(name: 'id_usuario_externo', referencedColumnName: 'id')]
    private ?usuarioExterno $usuarioExterno;

    public function __construct(string $asunto, string $descripcion, DateTime $fecha, int $prioridad, usuarioExterno $usuarioExterno)
    {
        $this->asunto = $asunto;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;
        $this->usuarioExterno = $usuarioExterno;
        $this->prioridad = $prioridad;
        
    } 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsunto(): ?string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto): self
    {
        $this->asunto = $asunto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }
    

    public function getUsuarioExterno(): ?UsuarioExterno
    {
        return $this->usuarioExterno;
    }

    public function setUsuarioExterno(?UsuarioExterno $usuarioExterno): self
    {
        $this->usuarioExterno = $usuarioExterno;

        return $this;
    }

    /**
     * Get the value of prioridad
     */ 
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set the value of prioridad
     *
     * @return  self
     */ 
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }
}
