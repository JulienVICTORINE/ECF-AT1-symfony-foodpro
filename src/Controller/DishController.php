<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishForm;
use App\Repository\DishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]

#[Route('/dishes')]
final class DishController extends AbstractController
{
    #[Route(name: 'app_dish_index', methods: ['GET'])]
    public function index(DishRepository $dishRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('dish/index.html.twig', [
                'dishes' => $dishRepository->findAll(),
            ]);
        }

        return $this->render('dish/index.html.twig', [
            'dishes' => $dishRepository->findBy(['owner' => $this->getUser()]),
        ]);
    }

    #[Route('/new', name: 'app_dish_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dish = new Dish();
        $form = $this->createForm(DishForm::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dish->setOwner($this->getUser());
            $entityManager->persist($dish);
            $entityManager->flush();

            return $this->redirectToRoute('app_dish_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dish/new.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dish_show', methods: ['GET'])]
    public function show(Dish $dish): Response
    {
        if ($this->getUser() !== $dish->getOwner() && !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('danger', 'Accès refusé');
            return $this->redirectToRoute('app_job_offer_index');
        }

        return $this->render('dish/show.html.twig', [
            'dish' => $dish,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dish_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dish $dish, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $dish->getOwner() && !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('danger', 'Accès refusé');
            return $this->redirectToRoute('app_dish_index');
        }

        $form = $this->createForm(DishForm::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dish_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dish/edit.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dish_delete', methods: ['POST'])]
    public function delete(Request $request, Dish $dish, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser() !== $dish->getOwner() && !$this->isGranted('ROLE_ADMIN')) {
            $this->addFlash('danger', 'Accès refusé');
            return $this->redirectToRoute('app_dish_index');
        }

        if ($this->isCsrfTokenValid('delete'.$dish->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dish);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dish_index', [], Response::HTTP_SEE_OTHER);
    }
}
