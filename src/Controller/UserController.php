<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user_list')]
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/user/{id}', name: 'user_show')]
    public function show($id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('admin/user/create', name: 'user_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User;

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_list');
        }

        $formView = $form->createView();

        return $this->render('user/create.html.twig', [
            'formView' => $formView,
        ]);
    }
}
