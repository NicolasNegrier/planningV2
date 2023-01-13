<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'task_list')]
    public function list(TaskRepository $taskRepository): Response
    {
        $tasks = $taskRepository->findAll();

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    #[Route('admin/task/create', name: 'task_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $task = new Task;

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_list');
        }

        $formView = $form->createView();

        return $this->render('task/create.html.twig', [
            'formView' => $formView,
        ]);
    }
}
