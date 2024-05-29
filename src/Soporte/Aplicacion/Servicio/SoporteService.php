<?php

namespace App\Soporte\Aplicacion\Servicio;

use App\Soporte\Dominio\Entidades\UsuarioExterno;
use App\Soporte\Dominio\Entidades\Soporte;
use App\Soporte\Infraestructura\Persistencia\SoporteRepository;
use DateTime;

class SoporteService
{
    private SoporteRepository $soporteRepository;

    public function __construct(SoporteRepository $soporteRepository)
    {
        $this->soporteRepository = $soporteRepository;
    }


    public function registrar(string $asunto, string $descripcion, DateTime $fecha, int $prioridad, UsuarioExterno $usuarioExterno): Soporte
    {

        $soporte = new Soporte($asunto, $descripcion, $fecha, $prioridad, $usuarioExterno);
        $this->soporteRepository->registrarSoporte($soporte);

        return $soporte;
    }
}
