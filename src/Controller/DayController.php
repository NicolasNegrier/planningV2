<?php

namespace App\Controller;

use App\Entity\Day;
use App\Form\DayType;
use App\Repository\DayRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractController
{
    #[Route('/day', name: 'day_list')]
    public function list(DayRepository $dayRepository): Response
    {
        $days = $dayRepository->findAll();

        return $this->render('day/list.html.twig', [
            'days' => $days
        ]);
    }

    #[Route('/day/{id}', name: 'day_show')]
    public function show($id, DayRepository $dayRepository): Response
    {
        $day = $dayRepository->find($id);
        return $this->render('day/show.html.twig', [
            'day' => $day
        ]);
    }

    #[Route('/day/{day_id}/{user_id}', name: 'day_userView')]
    public function user($day_id, $user_id, DayRepository $dayRepository, UserRepository $userRepository): Response
    {
        $day = $dayRepository->find($day_id);

        $user = $userRepository->find($user_id);

        return $this->render('day/userView.html.twig', [
            'day' => $day,
            'user' => $user
        ]);
    }

    #[Route('/admin/day/create', name: 'day_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $day = new Day;

        $form = $this->createForm(DayType::class, $day);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($day);
            $em->flush();

            return $this->redirectToRoute('day_show', [
                'id' => $day->getId()
            ]);
        }

        $formView = $form->createView();

        return $this->render('day/create.html.twig', [
            'formView' => $formView
        ]);
    }
}
