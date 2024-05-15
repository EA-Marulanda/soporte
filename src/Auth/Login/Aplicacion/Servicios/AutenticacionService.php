<?php 

namespace App\Auth\Login\Aplicacion\Servicios;

use App\Auth\Login\Dominio\Repositorios\UsuarioRepositoryInterface;

class AutenticacionService
{
    private $userRepository;

    public function __construct(UsuarioRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function autenticar(string $nombreUsuario, string $contraseña): bool
    {
        // Lógica para autenticar al usuario
        $usuario = $this->userRepository->buscarPorNombreUsuario($nombreUsuario);

        if ($usuario && password_verify($contraseña, $usuario->getContrasena())) {
            // Usuario autenticado correctamente
            return true;
        }

        // Usuario no autenticado
        return false;
    }
}