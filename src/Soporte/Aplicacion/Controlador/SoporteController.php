<?php

namespace App\Soporte\Aplicacion\Controlador;

use App\Soporte\Aplicacion\Servicio\SoporteService;
use App\Forms\Soporte\SoporteType;
use App\seguridad\DetectorInyeccionSQL;
use App\Soporte\Aplicacion\Servicio\UsuarioExternoService;
use App\Soporte\Aplicacion\Servicio\UsuarioSoporteService;
use App\Soporte\Dominio\Entidades\UsuarioExterno;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/soporte', name: 'soporte_index')]
class SoporteController extends AbstractController
{
    private SoporteService $soporteService;
    private UsuarioSoporteService $usuarioSoporteService;
    private UsuarioExternoService $usuarioExternoService;
    private DetectorInyeccionSQL $detectorInyecccionSQL;

    public function __construct(
        SoporteService $soporteService,
        UsuarioSoporteService $usuarioSoporteService,
        UsuarioExternoService $usuarioExternoService,
        DetectorInyeccionSQL $detectorInyecccionSQL
    ) {
        $this->soporteService = $soporteService;
        $this->usuarioSoporteService = $usuarioSoporteService;
        $this->usuarioExternoService = $usuarioExternoService;
        $this->$detectorInyecccionSQL = $detectorInyecccionSQL;
    }


    #[Route('/registro-soporte', name: 'app_soporte_nuevo', methods: ['GET', 'POST'])]
    public function registroSoporte(Request $request): Response
    {
        $form = $this->createForm(SoporteType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($this->detectorInyecccionSQL->verificarFormulario($form)) {
                
            }

            $fechaActual = new \DateTime();
            $usuario = $this->usuarioSoporteService->usuarioMasCarga();

            $usuarioExterno = $this->usuarioExternoService->registrar(
                $form->get('cedula')->getData(),
                $form->get('nombre')->getData(),
                $form->get('correo')->getData(),
            );
            $soporte = $this->soporteService->registrar(
                $form->get('asunto')->getData(),
                $form->get('descripcion')->getData(),
                $fechaActual,
                $form->get('prioridad')->getData(),
                $usuarioExterno
            );



            return $this->redirectToRoute('app_home');
        }

        return $this->render('soporte/nuevo_soporte.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
