<?php

namespace App\Auth\Login\Application\Controller;

use App\Auth\Login\Application\AuthenticationService;
use App\Auth\Login\Domain\Model\Usuario;
use App\Forms\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route(path: '/', name: 'app_login')]
class LoginController extends AbstractController
{
    private AuthenticationService $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    //#[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $user = new Usuario('', '', '', false, true, []);
        $formLogin = $this->createForm(LoginType::class, $user);
        $formLogin->handleRequest($request);

        if ($formLogin->isSubmitted() && $formLogin->isValid()) {

            $username = $formLogin->get('usuario')->getData();
            $password = $formLogin->get('password')->getData();

            $user = $this->authenticationService->authenticate($username, $password);

            if ($user !== null) {
                return $this->redirectToRoute('some_protected_route');
            } else {
                $error = 'Credenciales inválidas. Por favor, inténtelo de nuevo.';
            }

            return $this->redirectToRoute('admin_user_index');
        }
        $error = $authenticationUtils->getLastAuthenticationError();



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
