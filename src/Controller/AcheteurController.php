<?php

namespace App\Controller;

use App\Entity\Acheteur;
use App\Form\AcheteurType;
use App\Repository\AcheteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/acheteur')]
class AcheteurController extends AbstractController
{
    #[Route('/', name: 'app_acheteur_index', methods: ['GET'])]
    public function index(AcheteurRepository $acheteurRepository): Response
    {
        return $this->render('acheteur/index.html.twig', [
            'acheteurs' => $acheteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_acheteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AcheteurRepository $acheteurRepository): Response
    {
        $acheteur = new Acheteur();
        $form = $this->createForm(AcheteurType::class, $acheteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $acheteurRepository->save($acheteur, true);

            return $this->redirectToRoute('app_acheteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acheteur/new.html.twig', [
            'acheteur' => $acheteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acheteur_show', methods: ['GET'])]
    public function show(Acheteur $acheteur): Response
    {
        return $this->render('acheteur/show.html.twig', [
            'acheteur' => $acheteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_acheteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Acheteur $acheteur, AcheteurRepository $acheteurRepository): Response
    {
        $form = $this->createForm(AcheteurType::class, $acheteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $acheteurRepository->save($acheteur, true);

            return $this->redirectToRoute('app_acheteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('acheteur/edit.html.twig', [
            'acheteur' => $acheteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_acheteur_delete', methods: ['POST'])]
    public function delete(Request $request, Acheteur $acheteur, AcheteurRepository $acheteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acheteur->getId(), $request->request->get('_token'))) {
            $acheteurRepository->remove($acheteur, true);
        }

        return $this->redirectToRoute('app_acheteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
