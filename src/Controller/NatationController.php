<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NatationController extends AbstractController
{
    #[Route('/natation', name: 'app_natation')]
    public function index(): Response
    {
        return $this->render('natation/index.html.twig', [
            'controller_name' => 'NatationController',
        ]);
    }
}
