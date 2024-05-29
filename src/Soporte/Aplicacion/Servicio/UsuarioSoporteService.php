<?php

namespace App\Soporte\Aplicacion\Servicio;

use App\Auth\Login\Domain\Model\Usuario;
use App\Soporte\Dominio\Entidades\UsuarioExterno;
use App\Soporte\Dominio\Entidades\UsuarioSoporte;
use App\Soporte\Infraestructura\Persistencia\UsuarioSoporteRepository;

class UsuarioSoporteService
{
    private UsuarioSoporteRepository $usuarioSoporteRepository;
    
    public function __construct(UsuarioSoporteRepository $usuarioSoporteRepository)
    {
        $this->usuarioSoporteRepository = $usuarioSoporteRepository;
        
    }

    public function createSoporte(string $asunto, string $descripcion, string $fecha, UsuarioExterno $usuarioExterno): void
    {
        $usuarioSoporte = new UsuarioSoporte($asunto, $descripcion,$fecha, $usuarioExterno);
        $this->usuarioSoporteRepository->registrarSoporte($usuarioSoporte);
    }

    public function usuarioMasCarga(){
        return $this->usuarioSoporteRepository -> usuarioMasCarga();
    }
   

}