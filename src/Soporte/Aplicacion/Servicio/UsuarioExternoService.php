<?php

namespace App\Soporte\Aplicacion\Servicio;

use App\Soporte\Dominio\Entidades\UsuarioExterno;
use App\Soporte\Dominio\Entidades\Soporte;
use App\Soporte\Infraestructura\Persistencia\SoporteRepository;
use App\Soporte\Infraestructura\Persistencia\UsuarioExternoRepository;

class UsuarioExternoService
{
    private UsuarioExternoRepository $usuarioExternoRepository;

    public function __construct(UsuarioExternoRepository $usuarioExternoRepository)
    {
        $this->usuarioExternoRepository = $usuarioExternoRepository;
    }


    public function registrar(string $cedula, string $nombre, string $correo): UsuarioExterno
    {

        $usuarioExterno = new UsuarioExterno($cedula, $nombre, $correo);
        $this->usuarioExternoRepository->registrar($usuarioExterno);
        
        return $usuarioExterno;
    }
}
