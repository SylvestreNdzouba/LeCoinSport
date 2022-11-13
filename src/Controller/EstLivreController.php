<?php

namespace App\Controller;

use App\Entity\EstLivre;
use App\Form\EstLivreType;
use App\Repository\EstLivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/est/livre')]
class EstLivreController extends AbstractController
{
    #[Route('/', name: 'app_est_livre_index', methods: ['GET'])]
    public function index(EstLivreRepository $estLivreRepository): Response
    {
        return $this->render('est_livre/index.html.twig', [
            'est_livres' => $estLivreRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_est_livre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EstLivreRepository $estLivreRepository): Response
    {
        $estLivre = new EstLivre();
        $form = $this->createForm(EstLivreType::class, $estLivre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estLivreRepository->save($estLivre, true);

            return $this->redirectToRoute('app_est_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('est_livre/new.html.twig', [
            'est_livre' => $estLivre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_est_livre_show', methods: ['GET'])]
    public function show(EstLivre $estLivre): Response
    {
        return $this->render('est_livre/show.html.twig', [
            'est_livre' => $estLivre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_est_livre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EstLivre $estLivre, EstLivreRepository $estLivreRepository): Response
    {
        $form = $this->createForm(EstLivreType::class, $estLivre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $estLivreRepository->save($estLivre, true);

            return $this->redirectToRoute('app_est_livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('est_livre/edit.html.twig', [
            'est_livre' => $estLivre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_est_livre_delete', methods: ['POST'])]
    public function delete(Request $request, EstLivre $estLivre, EstLivreRepository $estLivreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estLivre->getId(), $request->request->get('_token'))) {
            $estLivreRepository->remove($estLivre, true);
        }

        return $this->redirectToRoute('app_est_livre_index', [], Response::HTTP_SEE_OTHER);
    }
}
