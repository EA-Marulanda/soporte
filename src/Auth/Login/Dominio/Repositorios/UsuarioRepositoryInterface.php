<?php

namespace App\Auth\Login\Dominio\Repositorios;

use App\Auth\Login\Dominio\Entidades\Usuario;

interface UsuarioRepositoryInterface
{
    public function buscarPorNombreUsuario(string $nombreUsuario): ?Usuario;
}