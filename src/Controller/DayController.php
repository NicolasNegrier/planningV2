<?php

namespace App\Controller;

use App\Entity\DailyTask;
use App\Entity\Day;
use App\Form\DailyTaskType;
use App\Form\DayType;
use App\Form\UserType;
use App\Repository\DailyTaskRepository;
use App\Repository\DayRepository;
use App\Repository\TaskRepository;
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

    #[Route('/day/{id}/edit', name: 'day_edit')]
    public function edit($id, DayRepository $dayRepository, Request $request, EntityManagerInterface $em): Response
    {
        $day = $dayRepository->find($id);

        $form = $this->createForm(DayType::class, $day);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            return $this->redirectToRoute('day_show', [
                'id' => $day->getId()
            ]);
        }

        $formView = $form->createView();

        return $this->render('day/edit.html.twig', [
            'formView' => $formView,
            'day' => $day
        ]);
    }


    #[Route('/day/{day_id}/task', name: 'day_taskShow')]
    public function taskShow($day_id, DayRepository $dayRepository): Response
    {
        $day = $dayRepository->find($day_id);

        return $this->render('day/tasksShow.html.twig', [
            'day' => $day
        ]);
    }


    #[Route('/day/{day_id}/{task_id}/assign', name: 'day_taskAssign')]
    public function taskAssign($day_id, $task_id, DayRepository $dayRepository, TaskRepository $taskRepository, DailyTaskRepository $dailyTaskRepository, Request $request, EntityManagerInterface $em): Response
    {
        $dailyTask = $dailyTaskRepository->findOneBy([
            'day' => $day_id,
            'task' => $task_id
        ]);

        if (!$dailyTask) {
            $dailyTask = new DailyTask;
            $day = $dayRepository->find($day_id);
            $task = $taskRepository->find($task_id);
            $dailyTask->setDay($day)
                ->setTask($task);

            $em->persist($dailyTask);
        }

        // $form = $this->createForm(DailyTaskType::class, $dailyTask);

        // $form->handleRequest($request);

        // $formView = $form->createView();

        return $this->render('day/taskAssign.html.twig', [
            'dailyTask' => $dailyTask,
            // 'formView' => $formView
        ]);
    }


    #[Route('/day/{day_id}/{user_id}', name: 'day_userView')]
    public function userView($day_id, $user_id, DayRepository $dayRepository, UserRepository $userRepository): Response
    {
        $day = $dayRepository->find($day_id);

        $user = $userRepository->find($user_id);

        return $this->render('day/userView.html.twig', [
            'day' => $day,
            'user' => $user
        ]);
    }

    #[Route('/day/{day_id}/{user_id}/edit', name: 'day_userEdit')]
    public function userEdit($day_id, $user_id, DayRepository $dayRepository, UserRepository $userRepository, Request $request, EntityManagerInterface $em): Response
    {
        $day = $dayRepository->find($day_id);

        $user = $userRepository->find($user_id);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->flush();

            return $this->redirectToRoute('day_userView', [
                'day' => $day,
                'user' => $user,
                'day_id' => $day->getId(),
                'user_id' => $user->getId(),
            ]);
        }

        $formView = $form->createView();

        return $this->render('day/userEdit.html.twig', [
            'day' => $day,
            'user' => $user,
            'formView' => $formView
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
