<?php

namespace App\Soporte\Dominio\Repositorio;

use App\Auth\Login\Domain\Model\Usuario;
use App\Soporte\Dominio\Entidades\UsuarioSoporte;

interface UsuarioSoporteRepositoryInterface
{
    public function registrarUsuarioSoporte(UsuarioSoporte $soporte): void;
    public function usuarioMasCarga():?Usuario;
 
}
