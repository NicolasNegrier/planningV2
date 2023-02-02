<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DailyTaskController extends AbstractController
{
    #[Route('/{day_id}/task', name: 'app_daily_task')]
    public function index(): Response
    {
        return $this->render('daily_task/index.html.twig', [
            'controller_name' => 'DailyTaskController',
        ]);
    }
}
