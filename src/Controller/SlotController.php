<?php

namespace App\Controller;

use App\Entity\Slot;
use App\Form\SlotType;
use App\Repository\SlotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SlotController extends AbstractController
{
    #[Route('/admin/slot/create', name: 'slot_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $slot = new Slot;

        $form = $this->createForm(SlotType::class, $slot);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $slot->setValue(30);
            $em->persist($slot);
            $em->flush();

            return $this->redirectToRoute('slot_list');
        }

        $formView = $form->createView();

        return $this->render('slot/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/slot', name: 'slot_list')]
    public function list(SlotRepository $slotRepository): Response
    {
        $slots = $slotRepository->findAll();

        return $this->render('slot/list.html.twig', [
            'slots' => $slots,
        ]);
    }
}
