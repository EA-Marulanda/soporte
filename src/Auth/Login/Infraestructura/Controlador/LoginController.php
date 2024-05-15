<?php

namespace App\Auth\Login\Infraestructura\Controlador;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{


    public function login(Request $request): Response
    {
        $error = $request->attributes->get('error');

        return $this->render('auth/login.html.twig', [
            'error' => $error
        ]);
    }

    public function logout(): Response
    {
        throw new \LogicException('Esta acción nunca debería ser llamada directamente.');
    }
}

