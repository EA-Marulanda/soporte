<?php

namespace App\Soporte\Dominio\Repositorio;

use App\Soporte\Dominio\Entidades\Soporte;

interface SoporteRepositoryInterface
{
    public function registrarSoporte(Soporte $user): void;
 
}
