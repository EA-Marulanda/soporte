<?php

namespace App\Auth\Login\Application\Controller;

use App\Auth\Login\Application\UserService;
use App\Auth\Login\Domain\Model\Rol;
use App\Auth\Login\Domain\Model\Usuario;
use App\Forms\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/admin/users', name: 'admin_user_index')]
class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/', name: 'admin_user_index', methods: ['GET'])]
    public function index(): Response
    {
        $users = $this->userService->getAllUsers();

        return $this->render('admin/user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $roles = $this->userService->getAllRoles();
        $rol = new Rol("funcionario"); 

        $user = new Usuario('', '', '', false, true, $rol);
        $form = $this->createForm(UsuarioType::class, $user, ['roles' => $roles]);
      
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->createUser(
                $form->get('nombre')->getData(),
                $form->get('usuario')->getData(),
                $form->get('password')->getData(),
                $form->get('tiene_captcha')->getData(),
                true,
                $form->get('rol')->getData()
                
            );

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, int $id): Response
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $roles = $this->userService->getAllRoles();
        $form = $this->createForm(UsuarioType::class, $user, ['roles' => $roles]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->updateUser(
                $user,
                $form->get('usuario')->getData(),
                $form->get('nombre')->getData(),
                $form->get('tiene_captcha')->getData(),

                $form->get('password')->getData(),
                $form->get('rol')->getData()
            );

            return $this->redirectToRoute('admin_user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(Request $request, int $id): Response
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $this->userService->deleteUser($user);
        }

        return $this->redirectToRoute('admin_user_index');
    }

    #[Route('/{id}', name: 'admin_change_state', methods: ['POST'])]
    public function changeEstate(Request $request, int $id): Response
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $user->setEstado(!$user->getEstado());
        $this->userService->updateEstado($user);

        return new JsonResponse(['status' => 'success', 'enabled' => $user->getEstado()]);
    }
}
