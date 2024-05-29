<?php

namespace App\Auth\Login\Application\Controller;

use App\Auth\Login\Application\AuthenticationService;
use App\Auth\Login\Domain\Model\Rol;
use App\Auth\Login\Domain\Model\Usuario;
use App\Forms\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

#[Route(path: '/', name: 'app_inicio_sesion')]
class LoginController extends AbstractController
{
    private AuthenticationService $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    //#[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]


    #[Route('/iniciarsesion', name: 'app_inicio_sesion', methods: ['GET', 'POST'])]
    public function iniciarSesion(Request $request, AuthenticationUtils $authenticationUtils, TokenStorageInterface $tokenStorage): Response
    {
        $rol = new Rol("funcionario");
        $user = new Usuario('', '', '', false, true, $rol);
        $formLogin = $this->createForm(LoginType::class);
        $formLogin->handleRequest($request);
        $error = null;

        //$error = new AuthenticationException('Credenciales inválidas.');

        if ($formLogin->isSubmitted() && $formLogin->isValid()) {

            $username = $formLogin->get('usuario')->getData();
            $password = $formLogin->get('password')->getData();
            $user = $this->authenticationService->authenticate($username, $password);

            if ($user !== null) {
                // Crear un nuevo token de autenticación

                //            $token = new UsernamePasswordToken($user, '', ['main'], $user->getRoles());


                // Almacenar el token en la sesión
                //          $tokenStorage->setToken($token);

                // Redirigir a la ruta protegida
                return $this->redirectToRoute('dashboard', ['userId' => $user->getRol()]);
            } else {
                $error = new AuthenticationException('Credenciales inválidas.');
                // $error->setTokenKey('invalid_credentials_key');
            }
        }

        // $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('auth/login.html.twig', [
            'formLogin' => $formLogin->createView(),
            'error' => $error,
        ]);
    }


    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \Exception('This should never be reached!');
    }
}
