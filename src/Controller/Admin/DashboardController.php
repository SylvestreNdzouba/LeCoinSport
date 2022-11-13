<?php

namespace App\Controller\Admin;

use App\Entity\Acheteur;
use App\Entity\CategorieProduit;
use App\Entity\Commande;
use App\Entity\Contact;
use App\Entity\EstLivre;
use App\Entity\Livraison;
use App\Entity\ModePaiement;
use App\Entity\Produit;
use App\Entity\Users;
use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Security\Permission;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
       
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ContactCrudController::class)
            ->generateUrl();

         return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LeCoinSport');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Acheteur', 'fas fa-bars')
            ->setPermission("ROLE_ADMIN")
            ->setSubItems([
            MenuItem::linkToCrud('Ajout acheteur', 'fas fa-plus', Acheteur::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer acheteurs', 'fas fa-eye', Acheteur::class)
        ]);

        yield MenuItem::subMenu('Acheteur', 'fas fa-bars')
            ->setPermission("ROLE_INTER")
            ->setSubItems([
            MenuItem::linkToCrud('Ajout acheteur', 'fas fa-plus', Acheteur::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer acheteurs', 'fas fa-eye', Acheteur::class)
        ]);

        yield MenuItem::subMenu('Catégorie', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout catégorie', 'fas fa-plus', CategorieProduit::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer catégories', 'fas fa-eye', CategorieProduit::class)
        ]);
        
        yield MenuItem::subMenu('Contact', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout message', 'fas fa-plus', Contact::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer messages', 'fas fa-eye', Contact::class)
        ]);

        yield MenuItem::subMenu('Commande', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout commande', 'fas fa-plus', Commande::class)
            ->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer commande', 'fas fa-eye', Commande::class)
        ]);

        yield MenuItem::subMenu('Est livre', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout confirmation livraison', 'fas fa-plus', EstLivre::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer confirmations livraions', 'fas fa-eye', EstLivre::class)
        ]);

        yield MenuItem::subMenu('Livraison', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout livraison', 'fas fa-plus', Livraison::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer livraisons', 'fas fa-eye', Livraison::class)
        ]);

        yield MenuItem::subMenu('Mode de paiement', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout mode de paiement', 'fas fa-plus', ModePaiement::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer modes de paiment', 'fas fa-eye', ModePaiement::class)
        ]);

        yield MenuItem::subMenu('Produit', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout produit', 'fas fa-plus', Produit::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer produits', 'fas fa-eye', Produit::class)
        ]);

        yield MenuItem::subMenu('Produit', 'fas fa-bars')
        ->setPermission("ROLE_INTER")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout produit', 'fas fa-plus', Produit::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer produits', 'fas fa-eye', Produit::class)
        ]);

        yield MenuItem::subMenu('Utilisateur', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout utilisateur', 'fas fa-plus', Users::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer utilisateurs', 'fas fa-eye', Users::class)
        ]);

        yield MenuItem::subMenu('Utilisateur', 'fas fa-bars')
        ->setPermission("ROLE_INTER")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout utilisateur', 'fas fa-plus', Users::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer utilisateurs', 'fas fa-eye', Users::class)
        ]);

        yield MenuItem::subMenu('Ville', 'fas fa-bars')
        ->setPermission("ROLE_ADMIN")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout ville', 'fas fa-plus', Ville::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer villes', 'fas fa-eye', Ville::class)
        ]);

        yield MenuItem::subMenu('Ville', 'fas fa-bars')
        ->setPermission("ROLE_INTER")
        ->setSubItems([
            MenuItem::linkToCrud('Ajout ville', 'fas fa-plus', Ville::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Montrer villes', 'fas fa-eye', Ville::class)
        ]);
    }
}
