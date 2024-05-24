<?php

namespace App\dashboard\Infraestructura\Controlador;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{


    public function index(): Response
    {
        return $this->render('dashboard/admin/dashboard.html.twig');
        //return $this->render('dashboard/funcionario/dashboard.html.twig');
    }
}

