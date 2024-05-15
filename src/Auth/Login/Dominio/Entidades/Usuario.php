<?php

namespace App\Auth\Login\Dominio\Entidades;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

class Usuario implements UserInterface
{
    private $nombre;
    private $usuario;
    private $contrasena;
    private $id_rol;
    private $tiene_captcha;

    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getUsuario(): string
    {
        return $this->usuario;
    }


    public function getRoles(): Array
    {
        return $this->id_rol;
    }

    public function getContrasena(): string
    {
        return $this->contrasena;
    }

    public function getTieneCaptcha(): bool{
        return $this -> tiene_captcha;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        
    }

    public function getUserIdentifier(): string
    {
        return "";
    }
}
