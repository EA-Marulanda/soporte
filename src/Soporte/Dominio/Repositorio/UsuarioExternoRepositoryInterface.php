<?php

namespace App\Soporte\Dominio\Repositorio;

use App\Soporte\Dominio\Entidades\UsuarioExterno;

interface UsuarioExternoRepositoryInterface
{
    public function registrar(UsuarioExterno $usuarioExterno): void;
 
}
