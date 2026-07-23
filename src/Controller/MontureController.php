<?php

namespace App\Controller;

use App\Entity\Monture;
use App\Form\MontureType;
use App\Repository\MontureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/monture')]
final class MontureController extends AbstractController
{
    #[Route(name: 'app_monture_index', methods: ['GET'])]
    public function index(MontureRepository $montureRepository): Response
    {
        return $this->render('monture/index.html.twig', [
            'montures' => $montureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monture = new Monture();
        $form = $this->createForm(MontureType::class, $monture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($monture);
            $entityManager->flush();

            return $this->redirectToRoute('app_monture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('monture/new.html.twig', [
            'monture' => $monture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monture_show', methods: ['GET'])]
    public function show(Monture $monture): Response
    {
        return $this->render('monture/show.html.twig', [
            'monture' => $monture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Monture $monture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MontureType::class, $monture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('monture/edit.html.twig', [
            'monture' => $monture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monture_delete', methods: ['POST'])]
    public function delete(Request $request, Monture $monture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($monture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monture_index', [], Response::HTTP_SEE_OTHER);
    }
}
